<?php

namespace App;
class Divide extends Computations
{
    public function calculate(): void
    {
        if ($this->arg2 == 0) {
            $this->result = "Error. You can't divide by zero.";
        } else {
            $this->result = (float)$this->arg1 / (float)$this->arg2;
        }
    }

}