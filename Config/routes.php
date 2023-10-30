<?php

use App\Controllers\CalculatorController;
use App\Controllers\HistoryController;

return [
    '/' => ['controller' => CalculatorController::class,'parameter' => 'ui'],
    '/history' => ['controller' => HistoryController::class,'parameter' => 'general'],
    '/session' => ['controller' => HistoryController::class,'parameter' => 'session'],
    '/calculate' => ['controller' => CalculatorController::class,'parameter' => 'calculate'],
];