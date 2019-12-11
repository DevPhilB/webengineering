<?php
include 'Node.class.php';
include 'Line.class.php';
// 1. d)
class Graph {
    private $nodes; // List<Node>

    public function __constructor() {
        $this->nodes = array();
    }

    public function addNode($id) {
        if(!array_key_exists($id, $this->$nodes)) {
            array_push($this->$nodes, new Node($id));
        }
    }

    public function addEdge($startId, $endId, $cost, $line) {
        if(!array_key_exists($startId) && !array_key_exists($endId)) {
            $startNode = new Node($startId);
            $endNode = new Node($endId);
            $edge = new Edge($endId, $cost, $line);
            $startNode->addEdge($edge);
            $endNode->addEdge($edge);
            array_push($this->$nodes, $startNode, $endNode);
        }
    }

    public function findNode($id) {
        if(array_key_exists($id, $this->nodes)) {
            return $this->nodes[$id];
        }
    }

    public function print() {
        foreach($this->nodes as $firstNode) {
            printf("%s", "Node $node->getId() ->");
            $edgeNodeIds = " ";
            foreach($this->nodes as $secondNode) {
                if($firstNode != $secondNode) {
                    if($firstNode->getEdge($secondNode) != null) {
                        $edgeNodeIds .= $secondNode->getId() . " ";
                    }
                }
            }
            $edgeNodeIds = substr($edgeNodeIds, 0, -1); // Remove last space
            printf("%s", "$edgeNodeIds");
        }
    }

    // Getter
    public function getNodes() {
        return $this->$nodes;
    }
}
?>
