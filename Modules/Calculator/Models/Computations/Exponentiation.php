<?php

namespace Modules\Calculator\Models\Computations;

use Modules\Calculator\Controllers\IExponentiation;
use Modules\Calculator\Models\Computation;

class Exponentiation extends Computation implements IExponentiation
{
    public function calculate(): void
    {
        $this->result = pow((float)$this->value1, (float)$this->value2);
        $this->logger->info("Операция возведения в степень: $this->value1 pow $this->value2 = $this->result");
    }
}
