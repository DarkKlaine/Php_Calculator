<?php

use Modules\Calculator\Controllers\IConsoleCalculatorController;
use Modules\Calculator\Controllers\IConsoleHistoryController;

return [
    'calculate' => ['controller' => IConsoleCalculatorController::class, 'action' => 'calculate', 'minArgs' => 2],
    'history' => ['controller' => IConsoleHistoryController::class, 'action' => 'showGeneral', 'minArgs' => 0],
];