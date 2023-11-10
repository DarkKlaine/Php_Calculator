<?php

namespace Modules\Calculator\Controllers;

use Engine\DTO\ConsoleRequestDTO;

interface IConsoleCalculatorController
{
    public function calculate(ConsoleRequestDTO $request): void;
}