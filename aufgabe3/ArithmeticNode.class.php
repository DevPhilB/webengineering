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
        // Numeric value
        if(is_numeric($this->value) == true) {
            return intval($this->value);
        } else { // Arithmetic node with operator
            // Check firstOperand for more nodes
            while(strcmp(gettype($this->firstOperand), "object") == 0) {
                $this->firstOperand = $this->firstOperand->getValue();
            }
            // Check secondOperand for more nodes
            while(strcmp(gettype($this->secondOperand), "object") == 0) {
                $this->secondOperand = $this->secondOperand->getValue();
            }
            // Calculate value
            $this->value = ($this->value)($this->firstOperand, $this->secondOperand);
            return $this->value;
        }
    }
}
?>