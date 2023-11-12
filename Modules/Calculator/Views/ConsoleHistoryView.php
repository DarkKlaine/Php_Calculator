<?php

namespace Modules\Calculator\Views;

use Modules\Calculator\Controllers\IConsoleHistoryView;

class ConsoleHistoryView implements IConsoleHistoryView
{
    public function display(string $historyString): void
    {
        echo $historyString;
    }
}