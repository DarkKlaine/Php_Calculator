<?php

use Modules\Calculator\Controllers\ICalculatorController;
use Modules\Calculator\Controllers\IHistoryController;

return [
    'calculate' => ['controller' => ICalculatorController::class, 'action' => 'calculate', 'minArgs' => 2],
    'history' => ['controller' => IHistoryController::class, 'action' => 'showGeneral', 'minArgs' => 0],
];