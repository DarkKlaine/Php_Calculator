<?php

namespace App;

class Multiply extends Computation
{
    public function calculate(): void
    {
        $this->result = (float) $this->value1 * (float) $this->value2;
        $this->logger->info("Операция умножения: $this->value1 * $this->value2 = $this->result");
    }

}