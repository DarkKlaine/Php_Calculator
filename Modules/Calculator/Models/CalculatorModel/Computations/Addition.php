<?php

namespace Modules\Calculator\Models\CalculatorModel\Computations;

use Modules\Calculator\Models\CalculatorModel\Computation;
use Modules\Calculator\Models\CalculatorModel\IAddition;

class Addition extends Computation implements IAddition
{
    public function calculate(): void
    {
        $this->result = (float)$this->value1 + (float)$this->value2;
        $this->logger->info("Операция сложения: $this->value1 + $this->value2 = $this->result");
    }
}
