<?php

use Modules\Calculator\Controllers\ConsoleControllers\IConsoleCalculatorController;
use Modules\Calculator\Controllers\ConsoleControllers\IConsoleHistoryController;

return [
    'calculate' => ['controller' => IConsoleCalculatorController::class, 'action' => 'calculate', 'minArgs' => 2],
    'history' => ['controller' => IConsoleHistoryController::class, 'action' => 'showGeneralHistory', 'minArgs' => 0],
    'dbhistory' => ['controller' => IConsoleHistoryController::class, 'action' => 'showDBHistory', 'minArgs' => 0],
];