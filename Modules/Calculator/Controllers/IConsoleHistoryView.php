<?php

namespace Modules\Calculator\Controllers;

interface IConsoleHistoryView
{
    public function display(string $historyString): void;
}