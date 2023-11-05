<?php

namespace Modules\Calculator\Computations;

class Exponentiation extends Computation
{
    public function calculate(): void
    {
        $this->result = pow((float)$this->value1, (float)$this->value2);
        $this->logger->info("Операция возведения в степень: $this->value1 pow $this->value2 = $this->result");
    }
}