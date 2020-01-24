<?php
require_once("model/PathNode.class.php");
require_once("Getter.class.php");
class Dijkstra
{


    private $process = array();
    private $getter = null;
    //constructs a new instance
    function __construct()
    {
        $this->getter = new Getter();
    }

    // 1. b) time DateTime object, minutes just a number
    function addTime($time, $minutes)
    {
        $timeClone = clone ($time);
        $timeClone->add(new DateInterval("PT" . $minutes . "M"));
        return $timeClone;
    }

    // 1. c) parameter endNode calculate 
    function getPath($endNode)
    {
        $pathNodes = array();
        $oldEndNode = 0;
        $preline = null;
        while ($endNode != null) {
            if ($endNode->getCost() == INF) {
                echo "no path found";
                return null;
            }else{
                if($oldEndNode == 0){
                    array_push($pathNodes, new PathNode($endNode->getId(), $endNode->getCost(), new Line(-1,-1,-1)));
                    $preline = $endNode->getPreLine();
                    $oldEndNode++;
                }
                else{
                    array_push($pathNodes, new PathNode($endNode->getId(), $endNode->getCost(), $preline));
                    $preline = $endNode->getPreLine();
                }
                $endNode = $endNode->getPreNode();
            }
        }
        return array_reverse($pathNodes);
    }


    // 1. d) array with Node objects
    function extractMinimum($process)
    {
        $elementKey = 0;
        $value = 1000;
        $lessCostNode = null;
        foreach ($process as $key => $node) {
            if ($node->getCost() < $value) {
                $value = $node->getCost();
                $lessCostNode = $node;
                $elementKey = $key;
            }
        }
        array_splice($this->process,  $elementKey, 1);
        return $lessCostNode;
    }


    // Sets the values for a node and der preNodes.
    function setupNeighbour($startNode, $startTime)
    {
        $edges = $startNode->getEdges();
        foreach ($edges as $edge) {
            $node = $edge->getEndNode();
            if ($node->getVisited() == false) {
                $costs = $edge->getCost() + $startNode->getCost();
                // $costs = $costs + $this->getNextDepatureCost($startNode, $this->addTime($startTime, $costs), $edge);
                if ($node->getCost() < $costs) {
                    $node->setCost($costs);
                    $node->setPreLine($edge->getLine());
                    $startNode->setPreLine($edge->getLine());
                    $node->setPreNode($startNode);
                }else{
                    $node->setCost($costs);
                    $node->setPreLine($edge->getLine());
                    $startNode->setPreLine($edge->getLine());
                    $node->setPreNode($startNode);
                    array_push($this->process, $node);
                }
            }
        }
    }

    // returns the additional costs.
    function getNextDepatureCost($node, $startTime)
    {
    // return 0;
        $id = $node->getId(); // works not, show moodle.
        $departures = $this->getter->getDepartures($id, $startTime);
        $line = $departures->getDepartures()[0]->getLine();
        return $departures->getDelay($line, $startTime);
    }

        // 2. a)
    // Sets nodes and pre nodes and the costs.
    function dijkstra($graph, $startNode, $startTime)
    {
        $startNode->setCost(0);
        array_push($this->process, $startNode);
        echo "\n dijkstra start...";
        while (count($this->process) > 0) {
            $node =  $this->extractMinimum($this->process);
            $cost = $node->getCost() + $this->getNextDepatureCost($node, $this->addTime($startTime, $node->getCost()));
            $node->setCost($cost);
            $this->setupNeighbour($node, $startTime); // check the edges and calculates the cost.
            $node->setVisited(true);
        }
        echo "\n dijkstra end.";
    }
}
