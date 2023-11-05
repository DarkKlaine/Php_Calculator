<?php

use Engine\Controllers\AuthController;
use Modules\Calculator\CalculatorController;
use Modules\Calculator\HistoryController;

return [
    '/' => ['controller' => CalculatorController::class, 'action' => 'showForm'],
    '/calculate' => ['controller' => CalculatorController::class, 'action' => 'calculate'],
    '/history' => ['controller' => HistoryController::class, 'action' => 'showGeneral'],
    '/session' => ['controller' => HistoryController::class, 'action' => 'showPersonal'],
    '/ushellnotpass' => ['controller' => AuthController::class, 'action' => 'accessDenied'],
    '/login' => ['controller' => AuthController::class, 'action' => 'login'],
];
