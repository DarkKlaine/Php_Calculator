<?php

namespace Modules\Calculator\Models\CalculatorModel\Computations;

use Modules\Calculator\Models\CalculatorModel\Computation;

class SinCosTan extends Computation
{

    public function getResult(string $value1, string $action, string $value2 = ''): string
    {
        switch ($action) {
            case "sin":
                $result = sin(deg2rad($value2));
                $this->logger->info("Операция вычисления синуса угла: sin($value2) = $result");
                break;
            case "cos":
                $result = cos(deg2rad($value2));
                $this->logger->info("Операция вычисления косинуса угла: cos($value2) = $result");
                break;
            case "tan":
                $result = tan(deg2rad($value2));
                $this->logger->info("Операция вычисления тангенса угла: tan($value2) = $result");
                break;
            default:
                $result = "Ошибка. Неправильный математический оператор.";
                $this->logger->error('Ошибка. Неправильный математический оператор.');
                break;
        }

        return $result;
    }
}
