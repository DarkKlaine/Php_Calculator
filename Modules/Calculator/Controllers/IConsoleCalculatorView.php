<?php

namespace Modules\Calculator\Controllers;

interface IConsoleCalculatorView
{
    public function display(string $input, string $result): void;
}