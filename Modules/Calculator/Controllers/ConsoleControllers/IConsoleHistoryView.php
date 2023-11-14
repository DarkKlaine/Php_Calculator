<?php

namespace Modules\Calculator\Controllers\ConsoleControllers;

interface IConsoleHistoryView
{
    public function display(string $historyString): void;
}