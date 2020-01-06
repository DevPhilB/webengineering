<?php
include_once 'Edge.class.php';
// 1. a)
class Node {
    private $nodeID;
    private $edges = array(); // List<Edge>

    public function __constructor($id) {
        printf("NODE CONSTRUCTOR \n");
        $this->nodeID = $id;
    }

    public function addEdge($edge) {
        array_push($this->edges, $edge);
    }

    public function getEdge($endNode) {
        foreach($this->edges as $edge) {
            $edgeEndNode = $edge->getEndNode();
            if($edgeEndNode->getId() == $endNode->getId()) {
                return $edge;
            }
        }
        return null;
    }

    // Getter
    public function getId() {
        return $this->nodeID;
    }

    // Getter
    public function setId($id) {
        $this->nodeID = $id;
    }

    public function getEdges() {
        return $this->edges;
    }
}
?>
