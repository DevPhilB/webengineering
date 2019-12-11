<?php
// 1. b)
class Line {
    private $id;
    private $display;
    private $heading;

    public function __constructor($id, $display, $heading) {
        $this->id = $id;
        $this->display = $display;
        $this->heading = $heading;
    }

    // Getter
    public function getId() {
        return $this->id;
    }

    // Getter
    public function getDisplay() {
        return $this->display;
    }

    // Getter
    public function getHeading() {
        return $this->heading;
    }
}
?>
