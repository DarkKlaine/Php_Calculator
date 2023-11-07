<?php

namespace Modules\Calculator\Controllers;

interface ICalculatorView
{
    public function render(string $input, string $result): void;
}