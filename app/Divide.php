<?php

class Divide extends Computations
{
    public function calculate(): void
    {
        if ($this->arg2 == 0) {
            $this->result = "You can't divide by zero";
        } else {
            $this->result = (float)$this->arg1 / (float)$this->arg2;
        }
    }

}