<?php

namespace Modules\Calculator\Models\CalculatorModel\Computations;

use Modules\Calculator\Models\CalculatorModel\Computation;
use Modules\Calculator\Models\CalculatorModel\ISinCosTan;

class SinCosTan extends Computation implements ISinCosTan
{

    public function getResult(string $value1, string $action, string $value2 = ''): string
    {
        switch ($action) {
            case "sin":
                $result = sin(deg2rad($value1));
                $this->logger->info("Операция вычисления синуса угла: $value1 sin = $result");
                break;
            case "cos":
                $result = cos(deg2rad($value1));
                $this->logger->info("Операция вычисления косинуса угла: $value1 cos = $result");
                break;
            case "tan":
                $result = tan(deg2rad($value1));
                $this->logger->info("Операция вычисления тангенса угла: $value1 tan = $result");
                break;
            default:
                $result = "Ошибка. Неправильный математический оператор.";
                $this->logger->error('Ошибка. Неправильный математический оператор.');
                break;
        }
        return $result;
    }
}
