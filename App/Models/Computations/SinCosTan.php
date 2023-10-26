<?php

namespace App\Models\Computations;

class SinCosTan extends Computation
{

    public function calculate(): void
    {
        switch ($this->action) {
            case "sin":
                $this->result = sin(deg2rad((float)$this->value1));
                $this->logger->info("Операция вычисления синуса угла: $this->value1 sin = $this->result");
                break;
            case "cos":
                $this->result = cos(deg2rad((float)$this->value1));
                $this->logger->info("Операция вычисления косинуса угла: $this->value1 cos = $this->result");
                break;
            case "tan":
                $this->result = tan(deg2rad((float)$this->value1));
                $this->logger->info("Операция вычисления тангенса угла: $this->value1 tan = $this->result");
                break;
            default:
                $this->result = "Error. Incorrect math.";
                $this->logger->error('Ошибка. Неправильный математический оператор.');
                break;
        }

    }
}