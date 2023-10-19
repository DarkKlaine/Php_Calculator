<?php

namespace App;
class Divide extends Computations
{
    public function calculate(): void
    {
        if ($this->value2 === '0') {
            $this->result = "Error. You can't divide by zero.";
        } else {
            $this->result = (float)$this->value1 / (float)$this->value2;
        }
    }

}