<?php
include 'ArithmeticNode.class.php';

// From 1.
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
$functionTable = array(
    "+" => "add",
    "-" => "sub",
    "*" => "mul",
    "/" => "div"
);
$input = "- * / 15 - 7 + 1 1 3 + 2 + 1 1";
$preprocessed = explode(" ", $input);

// 3. d) TODO
$arithmeticNode = new ArithmeticNode($preprocessed, $functionTable);
print_r($arithmeticNode);
$result = $arithmeticNode->getValue();
printf("%s", "Result for '- * / 15 - 7 + 1 1 3 + 2 + 1 1' = $result");
?>