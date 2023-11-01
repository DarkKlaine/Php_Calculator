<?php

use App\Controllers\AuthController;
use App\Controllers\CalculatorController;
use App\Controllers\HistoryController;

return [
    '/' => ['controller' => CalculatorController::class, 'action' => 'showForm'],
    '/calculate' => ['controller' => CalculatorController::class, 'action' => 'calculate'],
    '/history' => ['controller' => HistoryController::class, 'action' => 'showGeneral'],
    '/session' => ['controller' => HistoryController::class, 'action' => 'showPersonal'],
    '/ushellnotpass' => ['controller' => AuthController::class, 'action' => 'accessDenied'],
    '/login' => ['controller' => AuthController::class, 'action' => 'login'],
];
