<?php

namespace Modules\Calculator\Models\CalculatorModel\Computations;

use Modules\Calculator\Models\CalculatorModel\Computation;
use Modules\Calculator\Models\CalculatorModel\IMultiply;

class Multiply extends Computation implements IMultiply
{
    public function getResult(string $value1, string $action, string $value2 = ''): string
    {
        $result = $value1 * $value2;
        $this->logger->info("Операция умножения: $value1 * $value2 = $result");

        return $result;
    }
}
