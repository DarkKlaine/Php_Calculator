<?php

namespace App\Models\Computations;

class Exponentiation extends Computation
{
    public function calculate(): void
    {
        $this->result = pow((float)$this->value1, (float)$this->value2);
        $this->logger->info("Операция возыедения в степень: $this->value1 pow $this->value2 = $this->result");
    }

}