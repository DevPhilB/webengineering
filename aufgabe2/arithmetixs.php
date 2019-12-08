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

// 2. a)
function process($preprocessed, $functionTable) {
    $operationStack = array();
    $operandStack = array();
    $pendingOperand = true;
    $operatorSymbol = "";
    $operatorName = "";
    $operand_1 = 0;
    $operand = 0;
    for($i = 0; $i < count($preprocessed); ++$i) {
        if(array_key_exists($preprocessed[$i], $functionTable)) {
            array_push($operationStack, $preprocessed[$i]);
            $pendingOperand = false;
        } else {
            $operand = $preprocessed[$i];
            if($pendingOperand) {
                while(!empty($operandStack)) {
                    $operand_1 = array_shift($operandStack);
                    $operatorSymbol = array_shift($operationStack);
                    $operatorName = $functionTable[$operatorSymbol];
                    switch($operatorName) {
                        case "add":
                            $operand = add($operand_1, $operand);
                            break;
                        case "sub":
                            $operand = sub($operand_1, $operand);
                            break;
                        case "mul":
                            $operand = mul($operand_1, $operand);
                            break;
                        case "div":
                            $operand = div($operand_1, $operand);
                            break;
                    }
                }
            }
            array_push($operandStack, $operand);
            $pendingOperand = true;
        }
    }
    return $operandStack[0];
};
// 2. b)
//echo ((((1 + 1) + 7) - 15) / 3) * ((1 + 1) + 2);
echo process($preprocessed, $functionTable);
?>