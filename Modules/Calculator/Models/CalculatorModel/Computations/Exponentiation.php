<?php

namespace Modules\Calculator\Models\CalculatorModel\Computations;

use Modules\Calculator\Models\CalculatorModel\Computation;
use Modules\Calculator\Models\CalculatorModel\IExponentiation;

class Exponentiation extends Computation implements IExponentiation
{
    public function calculate(): void
    {
        $this->result = pow((float)$this->value1, (float)$this->value2);
        $this->logger->info("Операция возведения в степень: $this->value1 pow $this->value2 = $this->result");
    }
}
