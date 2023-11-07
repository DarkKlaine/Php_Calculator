<?php

namespace Modules\Calculator;

interface ICalculatorView
{
    public function render(string $input, string $result): void;
}