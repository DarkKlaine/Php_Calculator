<?php

use Engine\Router\IAuthController;
use Modules\Calculator\Controllers\IWebCalculatorController;
use Modules\Calculator\Controllers\IHistoryController;

return [
    '/' => ['controller' => IWebCalculatorController::class, 'action' => 'showForm'],
    '/calculate' => ['controller' => IWebCalculatorController::class, 'action' => 'calculate'],
    '/history' => ['controller' => IHistoryController::class, 'action' => 'showGeneral'],
    '/session' => ['controller' => IHistoryController::class, 'action' => 'showPersonal'],
    '/ushellnotpass' => ['controller' => IAuthController::class, 'action' => 'accessDenied'],
    '/login' => ['controller' => IAuthController::class, 'action' => 'login'],
];
