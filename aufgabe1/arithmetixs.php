<?php
// 1. a)
function add($param1, $param2) {
    return $param1 + $param2;
};
function sub($param1, $param2) {
    return $param1 - $param2;
};
function mul($param1, $param2) {
    return $param1 * $param2;
};
function div($param1, $param2) {
    return $param1 / $param2;
};
// 1. b)
$functionTable = array(
    "+" => "add",
    "-" => "sub",
    "*" => "mul",
    "/" => "div"
);
// 1. c)
$input = "- * / 15 - 7 + 1 1 3 + 2 + 1 1";
$preprocessed = explode(" ", $input);
print_r($preprocessed);
?>