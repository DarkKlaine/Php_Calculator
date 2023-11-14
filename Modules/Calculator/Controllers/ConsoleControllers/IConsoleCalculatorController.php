<?php

namespace Modules\Calculator\Controllers\ConsoleControllers;

use Engine\Router\ConsoleRouter\ConsoleRequestDTO;

interface IConsoleCalculatorController
{
    public function calculate(ConsoleRequestDTO $request): void;
}