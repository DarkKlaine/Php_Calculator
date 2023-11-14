<?php

namespace Modules\Calculator\Controllers\ConsoleControllers;

interface IConsoleCalculatorView
{
    public function display(string $input, string $result): void;
}