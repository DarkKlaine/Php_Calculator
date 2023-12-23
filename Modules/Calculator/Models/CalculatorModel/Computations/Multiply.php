<?php

namespace Modules\Calculator\Models\CalculatorModel\Computations;

use Modules\Calculator\Models\CalculatorModel\Computation;

class Multiply extends Computation
{
    public function getResult(string $value1, string $action, string $value2 = ''): string
    {
        $result = $value1 * $value2;
        $this->logger->info("Операция умножения: $value1 * $value2 = $result");

        return $result;
    }
}
