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
            $this->value = $functionTable[$frontChar];
            $this->firstOperand = new ArithmeticNode($inputArray, $functionTable);
            $this->secondOperand = new ArithmeticNode($inputArray, $functionTable);
            return $this;
        } else {
            $this->value = $frontChar;
            $this->firstOperand = null;
            $this->secondOperand = null;
            return $this;
        }
    }
    
    // 3. c)
    public function getValue() {
        if($this->value == null && ($this->firstOperand == null || $this->secondOperand == null)) {
            return null;
        }
        if(strcmp(gettype($this->value), "string") != 0) {
            return $this->value;
        } else if(strcmp(gettype($this->value), "string") == 0) {
            while(strcmp(gettype($this->firstOperand), "object") == 0) {
                $this->firstOperand = $this->firstOperand->getValue();
                while(strcmp(gettype($this->secondOperand), "object") == 0) {
                    $this->secondOperand = $this->secondOperand->getValue();
                }
            }
            // TODO: Check types, call methods like
            $this->value = $$this->value($this->firstOperand->value, $this->secondOperand->value);
            // Or:
            /*
            switch($this->value) {
                case "add":
                    $this->value = ($add)($this->firstOperand->value, $this->secondOperand->value);
                    break;
                case "sub":
                    $this->value = ($this->sub)($this->firstOperand->value, $this->secondOperand->value);
                    break;
                case "mul":
                    $this->value = ($this->mul)($this->firstOperand->value, $this->secondOperand->value);;
                    break;
                case "div":
                    $this->value = ($this->div)($this->firstOperand->value, $this->secondOperand->value);
                    break;
                }
                */
            return $this->value;
        }
    }
}
?>