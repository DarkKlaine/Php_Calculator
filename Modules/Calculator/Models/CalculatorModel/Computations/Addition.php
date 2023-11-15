<?php

namespace Modules\Calculator\Models\CalculatorModel\Computations;

use Modules\Calculator\Models\CalculatorModel\Computation;
use Modules\Calculator\Models\CalculatorModel\IAddition;

class Addition extends Computation implements IAddition
{
    public function getResult(string $value1, string $action, string $value2 = ''): string
    {
        $result = (float)$value1 + (float)$value2;
        $this->logger->info("Операция сложения: $value1 + $value2 = $result");
        return $result;
    }
}
