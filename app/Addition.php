<?php

namespace App;

class Addition extends Computation
{
    public function calculate(): void
    {
        $this->result = (float) $this->value1 + (float) $this->value2;
    }

}