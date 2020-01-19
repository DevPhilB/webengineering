<?php
    //models a node in the graph
    //in our setting, this node represents a stop
    class Node{
        private $id;
        private $edges;
        // 1. a)
        private $cost = INF; // distane to the startnode.
        private $preNode;  //node that we allready visit bevor.
        private $preLine;  // line we drive to this node.
        private $visited = false; // is node already visit;

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

        function getCost(){
            return $this->cost;
        }

        function getPreNode(){
            return $this->preNode;
        }

        function getPreLine(){
            return $this->preLine;
        }

        function getVisited(){
            return $this->visited;
        }

        function setCost($cost){
            $this->cost = $cost;
        }

        function setPreNode($preNode){
            $this->preNode =$preNode;
        }

        function setPreLine($preLine){
            $this->preLine=$preLine;
        }

        function setVisited($visited){
            $this->visited= $visited;
        }

        
        public function print(){
            echo "From " . $this->id . " edges " . count($this->edges) . " cost ". $this->cost  .".\n";
        }
    }
