<?php
class PathNode {
    // 2. a)
    private $id = 0;
    private $cost = 0;
    private $line = null; // Line

    // Getter
    public function getId() {
        return $id;
    }

    // Getter
    public function getCost() {
        return $cost;
    }

    // Getter
    public function getLine() {
        return $line;
    }
}
?>
