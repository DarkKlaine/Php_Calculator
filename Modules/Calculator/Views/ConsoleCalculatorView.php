<?php

namespace Modules\Calculator\Views;

use Modules\Calculator\Controllers\IConsoleCalculatorView;

class ConsoleCalculatorView implements IConsoleCalculatorView
{
    public function display(string $input, string $result): void
    {
        echo "Выражение: $input" . PHP_EOL;
        echo "Результат: \033[31m$result\033[0m" . PHP_EOL;
    }
}