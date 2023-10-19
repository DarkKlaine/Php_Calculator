<?php

namespace App;
class Subtraction extends Computations
{
    public function calculate(): void
    {
        $this->result = (float) $this->value1 - (float) $this->value2;
    }

}