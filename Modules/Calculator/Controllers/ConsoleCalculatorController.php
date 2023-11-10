<?php

namespace Modules\Calculator\Controllers;

use Engine\Controllers\ConsoleBaseController;
use Engine\DTO\ConsoleRequestDTO;
use JetBrains\PhpStorm\NoReturn;

class ConsoleCalculatorController extends ConsoleBaseController implements IConsoleCalculatorController
{
    private string $inputPattern = '/^-?\d+(\.\d+)? (([+\-\/*]|pow) -?\d+(\.\d+)?|sin|cos|tan)$/';

    #[NoReturn] public function calculate(ConsoleRequestDTO $request): void
    {
        $inputData = $request->getInputData();
    }
}
