<?php

namespace Modules\Calculator\Controllers\ConsoleControllers;

interface IConsoleHistoryController
{
    public function showGeneralHistory(): void;

    public function showDBHistory(): void;
}