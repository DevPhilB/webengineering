<?php
class ArithmeticNode {
    // 3. a)
    private $value;
    private $firstOperand;
    private $secondOperand;

    // 3. b)
    public function __construct(&$inputArray, $functionTable) {
        $frontChar = array_shift($inputArray);
        if(array_key_exists($frontChar, $functionTable)) {
            $this->$value = $functionTable[$frontChar];
            $this->$firstOperand = new ArithmeticNode($inputArray, $functionTable);
            $this->$secondOperand = new ArithmeticNode($inputArray, $functionTable);
        } else {
            $this->$value = $frontChar;
            $this->$firstOperand = null;
            $this->$secondOperand = null;
        }
    }
    
    // 3. c)
    public function getValue() {
        printf("%s", "Value is $value \n");
        if(gettype($value == "integer")) {
            return $value;
        } else {
            if(gettype($firstOperand != "integer")) {
                $firstOperand = $firstOperand->getValue();
            }
            if(gettype($secondOperand != "integer")) {
                $secondOperand = $secondOperand->getValue();
            }
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