<?php
include_once 'Node.class.php';
include_once 'Line.class.php';
// 1. c)
class Edge {
    private $endNode; // Node
    private $cost;
    private $line; // Line

    public function __construct($endNode, $cost, $line) {
        $this->endNode = $endNode;
        $this->cost = $cost;
        $this->line = new Line($line ,"testDisplay","testHeading");
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

    // Setter
    public function setEndNode($node) {
        $this->endNode = $node;
    }

    public function setCost($cos) {
        $this->cost = $cos;
    }

    public function setLine($lin) {
        $this->line = $lin;
    }
}
?>
