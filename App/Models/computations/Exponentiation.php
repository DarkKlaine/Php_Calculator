<?php

namespace App;

class Exponentiation extends Computation
{
    public function calculate(): void
    {
        $this->result = pow((float) $this->value1, (float) $this->value2);
    }

}