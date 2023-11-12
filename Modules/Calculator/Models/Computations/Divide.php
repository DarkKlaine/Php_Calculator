<?php

namespace Modules\Calculator\Models\Computations;

use Modules\Calculator\Models\Computation;
use Modules\Calculator\Models\IDivide;

class Divide extends Computation implements IDivide
{
    public function calculate(): void
    {
        if ($this->value2 === '0') {
            $this->result = "Error. You can't divide by zero.";
            $this->logger->info("Деление на ноль: $this->value1 / $this->value2");
        } else {
            $this->result = (float)$this->value1 / (float)$this->value2;
            $this->logger->info("Операция деления: $this->value1 / $this->value2 = $this->result");
        }
    }
}
