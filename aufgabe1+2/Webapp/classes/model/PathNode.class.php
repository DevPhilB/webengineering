<?php
include_once 'Line.class.php';
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

       // Getter
       public function setId($i) {
        $this->id = $i;
    }

    public function setCost($cos) {
        $this->cost = $cos;
    }

    public function setLine($lin) {
        $this->line = $lin;
    }

    public function print(){
        echo "From " . $this->id . " cost " . $this->cost . " line ". $this->line  .".\n";
    }
}
?>
