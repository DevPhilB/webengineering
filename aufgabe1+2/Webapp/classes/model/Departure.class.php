<?php
// 1. c)
class Departure {
    private $line;
    private $display;
    private $time; // DateTime

    public function __construct($line, $display, $time) {
        $this->line = $line;
        $this->display = $display;
        $this->time = $time;
    }

    // Getter
    public function getLine() {
        return $this->line;
    }

    // Getter
    public function getDisplay() {
        return $this->display;
    }

    // Getter
    public function getTime() {
        return $this->time;
    }
}
?>
