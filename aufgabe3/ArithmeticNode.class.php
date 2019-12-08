<?php
class ArithmeticNode {
    // 3. a)
    private $value = null;
    private $firstOperand = null;
    private $secondOperand = null;

    // 3. b)
    public function __construct(&$inputArray, $functionTable) {
        $frontChar = array_shift($inputArray);
        if(array_key_exists($frontChar, $functionTable)) {
            $value = $functionTable[$frontChar];
            $firstOperand = array_shift($inputArray);
            $secondOperand = array_shift($inputArray);
            if(empty($inputArray)) {
                return $this;
            }
            new ArithmeticNode($inputArray, $functionTable);
        } else {
            $value = $frontChar;
            $firstOperand = null;
            $secondOperand = null;
            if(empty($inputArray)) {
                return $this;
            }
            new ArithmeticNode($inputArray, $functionTable);
        }
    }
    
    // 3. c)
    function getValue() {
        if(gettype($value == "integer")) {
            return $value;
        } else {
            switch($value) {
                case "add":
                    $value = ($this->add)($firstOperand, $secondOperand);
                    break;
                case "sub":
                    $value = ($this->sub)($firstOperand, $secondOperand);
                    break;
                case "mul":
                    $value = ($this->mul)($firstOperand, $secondOperand);
                    break;
                case "div":
                    $value = ($this->div)($firstOperand, $secondOperand);
                    break;
            }
            return $value;
        }
    }
}
?>