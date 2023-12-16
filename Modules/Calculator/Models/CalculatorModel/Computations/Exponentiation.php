<?php

namespace Modules\Calculator\Models\CalculatorModel\Computations;

use Modules\Calculator\Models\CalculatorModel\Computation;

class Exponentiation extends Computation
{
    public function getResult(string $value1, string $action, string $value2 = ''): string
    {
        $result = pow($value1, $value2);
        $this->logger->info("Операция возведения в степень: $value1 pow $value2 = $result");

        return $result;
    }
}
