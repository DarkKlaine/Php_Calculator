<?php

namespace Modules\Calculator\Controllers\ConsoleControllers;

use Engine\Services\Routers\ConsoleRouter\ConsoleRequestDTO;

interface IConsoleCalculatorController
{
    public function calculate(ConsoleRequestDTO $request): void;
}