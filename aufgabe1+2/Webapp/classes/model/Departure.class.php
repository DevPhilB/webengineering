<?php
class Departure {
    // 1. c)
    private $line = 0;
    private $display = "";
    private $time = null; // DateTime

    // Getter
    public function getLine() {
        return $line;
    }

    // Getter
    public function getDisplay() {
        return $display;
    }

    // Getter
    public function getTime() {
        return $time;
    }
}
?>
