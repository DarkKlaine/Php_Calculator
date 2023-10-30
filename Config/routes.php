<?php

use App\Controllers\CalculatorController;
use App\Controllers\HistoryController;

return [
    '/' => ['controller' => CalculatorController::class,'action' => 'showForm'],
    '/calculate' => ['controller' => CalculatorController::class,'action' => 'calculate'],
    '/history' => ['controller' => HistoryController::class,'action' => 'showGeneral'],
    '/session' => ['controller' => HistoryController::class,'action' => 'showPersonal'],
];
