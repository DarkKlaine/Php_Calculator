<?php

namespace Modules\Calculator\Models\CalculatorModel\Computations;

use Modules\Calculator\Models\CalculatorModel\Computation;

class Subtraction extends Computation
{
    public function getResult(string $value1, string $action, string $value2 = ''): string
    {
        $result = $value1 - $value2;
        $this->logger->info("Операция вычитания: $value1 - $value2 = $result");

        return $result;
    }
}
