<?php
include_once 'Edge.class.php';
// 1. a)
class Node {
    private $nodeID;
    private $edges; // List<Edge>

    public function __constructor($nodeId) {
        $this->nodeID = $nodeId;
        $this->edges = array();
    }

    public function addEdge($edge) {
        array_push($this->$edges, $edge);
    }

    public function getEdge($endNode) {
        foreach($this->$edges as $edge) {
            if($edge->getEndNode() == $endNode) {
                return $edge->getEndNode();
            }
        }
        return null;
    }

    // Getter
    public function getId() {
        return $this->$nodeID;
    }
}
?>
