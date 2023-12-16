<?php

use Modules\Calculator\Controllers\ConsoleControllers\ConsoleCalculatorController;
use Modules\Calculator\Controllers\ConsoleControllers\ConsoleHistoryController;

return [
    'calculate' => ['controller' => ConsoleCalculatorController::class, 'action' => 'calculate', 'minArgs' => 2],
    'history' => ['controller' => ConsoleHistoryController::class, 'action' => 'showGeneralHistory', 'minArgs' => 0],
    'dbhistory' => ['controller' => ConsoleHistoryController::class, 'action' => 'showDBHistory', 'minArgs' => 0],
];
