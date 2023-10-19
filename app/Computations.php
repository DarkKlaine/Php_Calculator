<?php

abstract class Computations
{
    protected string $arg1;
    protected string $arg2;
    protected string $action;
    protected string|float $result;

    public function __construct(string $arg1, string $action, string $arg2)
    {
        $this->arg1 = $arg1;
        $this->action = $action;
        $this->arg2 = $arg2;
    }

    abstract public function calculate(): void;

    public function getResult(): string|float
    {
        $this->calculate();
        return $this->result;
    }

}