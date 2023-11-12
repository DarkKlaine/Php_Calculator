<?php

namespace Modules\Calculator\Models\Computations;

use Modules\Calculator\Models\Computation;
use Modules\Calculator\Models\IMultiply;

class Multiply extends Computation implements IMultiply
{
    public function calculate(): void
    {
        $this->result = (float)$this->value1 * (float)$this->value2;
        $this->logger->info("Операция умножения: $this->value1 * $this->value2 = $this->result");
    }
}
