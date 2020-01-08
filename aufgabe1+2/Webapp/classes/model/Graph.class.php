<?php
include_once 'Node.class.php';
include_once 'Line.class.php';
include_once 'Edge.class.php';

class Graph {
    private $nodes = array(); // List<Node>

    public function __construct() {

    }

    public function addNode($id) {
        if(!array_key_exists($id, $this->nodes)) {
            $node = new Node($id);
            echo "Created node: $id.\n";
            $this->nodes[$id] = $node;
        }else{
            echo "Node: $id alreday exist.\n";
        }
    }

    public function addEdge($startId, $endId, $cost, $line){
        $startNode = $this->getExistingNode($startId);
        $endNode = $this->getExistingNode($endId);

         if($startNode->getEdge($endNode) == null){
            echo "Created new edge from startId: $startId to endId: $endId.\n";
            $edge = new Edge($endNode, $cost, $line);
            $startNode->addEdge($edge);
         }else{
            echo "Edge from startId: $startId to endId: $endId already exist.\n";
         }
    }

    public function getExistingNode($id){
        foreach($this->nodes as $node){
            if($node->getId() == $id)
            {
                return $node;
            }
        }
        $node = new Node($id);
        array_push($this->nodes, $node);
        echo "Created new node.\n";
        return $node;
    }

    public function findNode($id) {
        // return $this->getExistingNode($id);
        if(array_key_exists($id, $this->nodes)) {
            return $this->nodes[$id];
        }
    }

    public function print() {
        foreach($this->nodes as $firstNode) {
            echo "Id: ". $firstNode->getId() . "-> ";
            foreach($firstNode->getEdges() as $edge) {
                $conNode = $edge->getEndNode();
                if($conNode != null){
                    echo $conNode->getId() . " ";
                }
            }
            echo "\n";
        }
    }
}
?>
