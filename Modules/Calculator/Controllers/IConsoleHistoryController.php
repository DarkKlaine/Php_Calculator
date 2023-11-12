<?php

namespace Modules\Calculator\Controllers;

use Engine\DTO\ConsoleRequestDTO;

interface IConsoleHistoryController
{
    public function showHistory(): void;
}