<?php

namespace App;
abstract class Computations
{
    protected string $value1;
    protected string $value2;
    protected string $action;
    protected string|float $result;

    public function __construct(string $arg1, string $action, string $arg2)
    {
        $this->value1 = $arg1;
        $this->action = $action;
        $this->value2 = $arg2;
    }

    abstract public function calculate(): void;

    public function getResult(): string|float
    {
        $this->calculate();
        return $this->result;
    }

}