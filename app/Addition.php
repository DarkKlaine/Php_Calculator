<?php

class Addition extends Computations
{
    public function calculate(): void
    {
        $this->result = (float) $this->arg1 + (float) $this->arg2;
    }


}