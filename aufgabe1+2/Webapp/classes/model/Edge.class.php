<?php
include_once 'Node.class.php';
include_once 'Line.class.php';
// 1. c)
class Edge {
    private $endNode; // Node
    private $cost;
    private $line; // Line

    public function __constructor($id, $cost, $line) {
        $this->endNode = new Node($id);
        $this->cost = $cost;
        $this->line = $line;
    }

    // Getter
    public function getEndNode() {
        return $this->endNode;
    }

    // Getter
    public function getCost() {
        return $this->cost;
    }

    // Getter
    public function getLine() {
        return $this->line;
    }
}
?>
