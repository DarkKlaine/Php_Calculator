<?php

namespace Modules\Calculator\Models\CalculatorModel\Computations;

use Modules\Calculator\Models\CalculatorModel\Computation;

class Divide extends Computation
{
    public function getResult(string $value1, string $action, string $value2 = ''): string
    {
        if ($value2 === '0') {
            $result = "Ошибка. Деление на ноль.";
            $this->logger->info("Деление на ноль: $value1 / $value2");
        } else {
            $result = $value1 / $value2;
            $this->logger->info("Операция деления: $value1 / $value2 = $result");
        }

        return $result;
    }
}
