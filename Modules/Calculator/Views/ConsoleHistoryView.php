<?php

namespace Modules\Calculator\Views;

use Modules\Calculator\Controllers\ConsoleControllers\IConsoleHistoryView;

class ConsoleHistoryView implements IConsoleHistoryView
{
    public function display(string $historyString): void
    {
        echo "\033[33mИстория:\033[0m" . PHP_EOL;
        echo "\033[33m$historyString\033[0m";
    }
}