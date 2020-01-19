<?php
require_once("Getter.class.php");
class Dijkstra
{


    private $process = array();
    //constructs a new instance
    function __construct()
    {
    }

    // 1. b) time DateTime object, minutes just a number
    function addTime($time, $minutes)
    {
        $timeClone = clone ($time);
        $timeClone->add(new DateInterval("PT" . $minutes . "M"));
        return $timeClone;
        // return DateTime
    }

    // 1. c) parameter endNode calculate 
    function getPath($endNode)
    {
        $pathNodes = array();
        while ($endNode->getPreNode() != null) {
            if ($endNode->getCost() == INF) {
                echo "no path found";
                return null;
            }else{
                $pathNodes[] = $endNode;
                $endNode = $endNode->getPreNode();
            }
        }
        return $pathNodes;
    }


    // 1. d) array with Node objects
    function extractMinimum($process)
    {
        $elementKey = 0;
        $value = 1000;
        $lessCostNode = null;
        foreach ($process as $key => $node) {

            if ($node->getCost() < $value) {
                // ONLY PRINT TODO: Remove at the end.
                if ($lessCostNode != null) {
                     print_r("\n Less node: " . $lessCostNode->getId() . " value: " . strval($lessCostNode->getCost()));
                }
                $value = $node->getCost();
                // print_r("Is better: " . $node->getId() . " value: " . $value  . "\n");

                $lessCostNode = $node;
                $elementKey = $key;
            }
        }

        array_splice($this->process, $elementKey);
        return $lessCostNode;
    }


    // 2. a)
    // Sets the values for a node and der preNodes.
    function setupNeighbour($startNode, $startTime)
    {
        $edges = $startNode->getEdges();
        foreach ($edges as $edge) {
            $node = $edge->getEndNode();
            if ($node->getVisited() == false) {
                $node->setPreLine($edge->getLine());
                $costs = $edge->getCost() + $startNode->getCost() + $this->getNextDepatureCost($startNode, $startTime, $edge);
                $node->setCost($costs);
                $node->setPreNode($startNode);
                $this->process[] = $node;
            }
        }
    }

    // returns the additional costs.
    function getNextDepatureCost($node, $startTime, $edge)
    {

        // return 0;
        // Enable to test myTestDijkstra return 0
        $getter = new Getter();
        $id = $node->getId();
        $departures = $getter->getDepartures($id, $startTime);
        return $departures->getDelay($edge->getLine()->getId(), $startTime);
    }

    // Sets nodes and pre nodes and the costs.
    function dijkstra($graph, $startNode, $startTime)
    {
        $startNode->setCost(0);
        array_push($this->process, $startNode);

        while (count($this->process) > 0) {
            // this node is again the startnode //do this until process is empty;
            $node =  $this->extractMinimum($this->process);
            $this->setupNeighbour($node, $startTime);
            $node->setVisited(true);
        }

        echo "\n dijkstra ende.";
    }
}
