<?php

use Engine\Router\IAuthController;
use Modules\Calculator\Controllers\ICalculatorController;
use Modules\Calculator\Controllers\IHistoryController;

return [
    '/' => ['controller' => ICalculatorController::class, 'action' => 'showForm'],
    '/calculate' => ['controller' => ICalculatorController::class, 'action' => 'calculate'],
    '/history' => ['controller' => IHistoryController::class, 'action' => 'showGeneral'],
    '/session' => ['controller' => IHistoryController::class, 'action' => 'showPersonal'],
    '/ushellnotpass' => ['controller' => IAuthController::class, 'action' => 'accessDenied'],
    '/login' => ['controller' => IAuthController::class, 'action' => 'login'],
];
