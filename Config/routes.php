<?php

use App\Controllers\CalculatorController;
use App\Controllers\GeneralHistoryController;
use App\Controllers\SessionHistoryController;
use App\Controllers\UIController;

return [
    '/' => ['controller' => UIController::class,'parameter' => 'ui'],
    '/history' => ['controller' => GeneralHistoryController::class,'parameter' => 'general'],
    '/session' => ['controller' => GeneralHistoryController::class,'parameter' => 'session'],
    '/calculate' => ['controller' => CalculatorController::class,'parameter' => 'calculate'],
];