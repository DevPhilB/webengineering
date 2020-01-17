<?php
    require_once("model/Node.php");
    class Dijkstra{


        //constructs a new instance
        function __construct(){
        }

        // 1. b) time DateTime object, minutes just a number
        function addTime($time, $minutes){
            $timeClone = clone($time);
            return date_add($timeClone, $minutes);
            // return DateTime
        }

        // 1. c) parameter endNode
        function getPath($endNode){
            
            if($endNode->getCost() == INF){
                return null;
            }

            if ($endNode->getPreNode() == null) {
                // start node was found.
            }
        }

        // 1. d) array with Node objects
        function extractMinimum($process){
            $elementNum = 0;
            $lessCostNode = $process[ $elementNum];
            foreach($process as $node){
                if ($lessCostNode->getCost() > $node->getCost()) {
                    $lessCostNode = $node;
                }
                $elementNum++;
            }
            array_splice($process,$elementNum);
            return $lessCostNode;
        }


        
    }
?>
