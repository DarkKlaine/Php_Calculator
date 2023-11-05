<?php

namespace Modules\Calculator\Computations;

class Addition extends Computation implements AdditionInterface
{
    public function calculate(): void
    {
        $this->result = (float)$this->value1 + (float)$this->value2;
        $this->logger->info("Операция сложения: $this->value1 + $this->value2 = $this->result");
    }
}
