<?php

namespace Modules\Calculator\Views;

class ConsoleHistoryView
{
    public function display(array $historyString): void
    {
        echo "\033[33mИстория:\033[0m" . PHP_EOL;
        echo "\033[33m$historyString\033[0m";
    }
}
