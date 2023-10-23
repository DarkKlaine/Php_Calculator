<?php

namespace App;

class SinCosTan extends Computation
{

    public function calculate(): void
    {
        $this->result = match ($this->action) {
            "sin" => sin(deg2rad((float)$this->value1)),
            "cos" => cos(deg2rad((float)$this->value1)),
            "tan" => tan(deg2rad((float)$this->value1)),
            default => "Error. Incorrect math.",
        };

    }
}