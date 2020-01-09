<?php
    //models a node in the graph
    //in our setting, this node represents a stop
    class Node{
        private $id;
        private $edges;

        //constructs a new instance
        function __construct($id){
            $this->id = $id;
            $this->edges = array();
        }

        //adds an outgoing edge to the node
        function addEdge($edge){
            array_push($this->edges, $edge);
        }
        //the id of the node and the stop it represents
        function getId(){
            return $this->id;
        }
        //outgoing edges
        function getEdges(){
            return $this->edges;
        }
        // returns the edge for the given end node
        // or null if no edge to the given node exists
        function getEdge($endNode) {
            foreach ($this->getEdges() as $edge) {
                if ($edge->getEndNode() === $endNode)
                    return $edge;
            }
        }
    }
?>
