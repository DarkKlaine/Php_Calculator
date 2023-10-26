<?php

namespace App\Models\Computations;

class Subtraction extends Computation
{
    public function calculate(): void
    {
        $this->result = (float)$this->value1 - (float)$this->value2;
        $this->logger->info("Операция вычитания: $this->value1 - $this->value2 = $this->result");
    }

}