<?php
// require_once("model/Node.php");
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
        return date_add($timeClone, $minutes);
        // return DateTime
    }

    // 1. c) parameter endNode calculate 
    function getPath($endNode)
    {

        if ($endNode->getCost() == INF) {
            return null;
        }

        if ($endNode->getPreNode() == null) {
            // start node was found.
        }
    }


    // 1. d) array with Node objects
    function extractMinimum($process)
    {
        $elementKey = 0;
        $value= 1000;
        $lessCostNode = null;
        foreach ($process as $key => $node) {
            
            if ($node->getCost() < $value) {
                if($lessCostNode != null){
                print_r("\n Less node: ".$lessCostNode->getId() ." value: ". strval($lessCostNode->getCost()));
            }
                $value = $node->getCost();
                print_r("Is better: ".$node->getId() ." value: " . $value  . "\n");
              
                $lessCostNode = $node;
                $elementKey = $key;
            }
        }
       
         array_splice($this->process, $elementKey);
        return $lessCostNode;
    }


    // 2. a)
    // Sets the values for a node and der preNodes.
    function setupNeighbour($startNode)
    {
        $edges = $startNode->getEdges();
        foreach ($edges as $edge) {
            $node = $edge->getEndNode();
            if ($node->getVisited() == false) {
                $node->setPreLine($edge->getLine());
                // new costs -> TODO: add cost from waiting
                // if node has already costs=> do something
                $costs = $edge->getCost() + $startNode->getCost();
                if ($node->getCost() != INF) {
                    // echo "\n -visited again";
                }
                $node->setCost($costs);
                $node->setPreNode($startNode);
                $this->process[] = $node;
            }
        }
    }

    function dijkstra($graph, $startNode, $startTime)
    {
        // Methode initalisiere abstand = cost.
        $startNode->setCost(0);
        array_push($this->process, $startNode);

        $pathNodes = array();
        while (count($this->process) > 0) {
            // this node is again the startnode //do this until process is empty;
            $node =  $this->extractMinimum($this->process);
            $this->setupNeighbour($node);
            $node->setVisited(true);
        }

        echo "\n dijkstra ende.";
    }

}
