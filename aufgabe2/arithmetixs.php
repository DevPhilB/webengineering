<?php
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
//

// 2. a)
function process($preprocessed, $functionTable) {
    $operationStack = array();
    $operandStack = array();
    $pendingOperand = false;
    $operatorSymbol = "";
    $operatorName = "";
    $operand_1 = 0;
    $operand = 0;
    for($i = 0; $i < count($preprocessed); $i++) {
        if(array_key_exists($preprocessed[$i], $functionTable)) {
            array_push($operationStack, $preprocessed[$i]);
            $pendingOperand = false;
        } else {
            $operand = $preprocessed[$i];
            if($pendingOperand) {
                while(!empty($operandStack)) {
                    $operand_1 = array_pop($operandStack);
                    $operatorSymbol = array_pop($operationStack);
                    $operatorName = $functionTable[$operatorSymbol];
                    $operand = $operatorName($operand_1, $operand);
                }
            }
            array_push($operandStack, $operand);
            $pendingOperand = true;
        }
    }
    return $operandStack[0];
};
// 2. b)
$solution = process($preprocessed, $functionTable);
printf("%s", "Solution for '- * / 15 - 7 + 1 1 3 + 2 + 1 1' = $solution");
?>