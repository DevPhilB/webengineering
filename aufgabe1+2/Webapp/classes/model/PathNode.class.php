<?php
include 'Line.class.php';
// 2. a)
class PathNode {
    private $id;
    private $cost;
    private $line; // <Line>

    public function __constructor($id, $cost, $line) {
        $this->id = $id;
        $this->cost = $cost;
        $this->line = $line;
    }

    // Getter
    public function getId() {
        return $this->id;
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
