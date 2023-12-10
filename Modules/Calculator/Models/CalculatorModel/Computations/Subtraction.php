<?php

namespace Modules\Calculator\Models\CalculatorModel\Computations;

use Modules\Calculator\Models\CalculatorModel\Computation;
use Modules\Calculator\Models\CalculatorModel\ISubtraction;

class Subtraction extends Computation implements ISubtraction
{
    public function getResult(string $value1, string $action, string $value2 = ''): string
    {
        $result = $value1 - $value2;
        $this->logger->info("Операция вычитания: $value1 - $value2 = $result");

        return $result;
    }
}
