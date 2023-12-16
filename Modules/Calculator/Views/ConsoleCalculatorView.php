<?php

namespace Modules\Calculator\Views;

class ConsoleCalculatorView
{
    public function display(string $input, string $result): void
    {
        echo "\033[33mВыражение: $input\033[0m" . PHP_EOL;
        echo "\033[33mРезультат: $result\033[0m" . PHP_EOL;
    }
}
