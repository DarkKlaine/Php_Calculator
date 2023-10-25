<?php

namespace App;

abstract class Computation
{
    protected string $value1;
    protected string $value2;
    protected string $action;
    protected string|float $result;

    public function __construct(string $value1, string $action, string $value2 = '')
    {
        $this->value1 = $value1;
        $this->action = $action;
        $this->value2 = $value2;
    }

    abstract public function calculate(): void;

    public function getResult(): string|float
    {
        $this->calculate();
        return $this->result;
    }

}