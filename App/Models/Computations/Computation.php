<?php

namespace App\Models\Computations;

use App\Models\Logger\CalculatorLogger;

abstract class Computation
{
    protected string $value1;
    protected string $value2;
    protected string $action;
    protected string|float $result;
    protected object $logger;

    public function __construct(string $value1, string $action, string $value2 = '')
    {
        $this->value1 = $value1;
        $this->action = $action;
        $this->value2 = $value2;
        $this->logger = new CalculatorLogger();
    }

    public function getResult(): string|float
    {
        $this->calculate();
        return $this->result;
    }

    abstract public function calculate(): void;

}