<?php

namespace Modules\Calculator\Models\CalculatorModel\Computations;

use Modules\Calculator\Models\CalculatorModel\Computation;

class Addition extends Computation
{
    public function getResult(string $value1, string $action, string $value2 = ''): string
    {
        $result = (float) $value1 + (float) $value2;
        $this->logger->info("Операция сложения: $value1 + $value2 = $result");

        return $result;
    }
}
