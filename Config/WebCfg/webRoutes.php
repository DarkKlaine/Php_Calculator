<?php

use Engine\Services\Routers\WebRouter\IAuthController;
use Modules\Calculator\Controllers\WebControllers\IWebCalculatorController;
use Modules\Calculator\Controllers\WebControllers\IWebHistoryController;

return [
    '/' => ['controller' => IWebCalculatorController::class, 'action' => 'showForm'],
    '/calculate' => ['controller' => IWebCalculatorController::class, 'action' => 'calculate'],
    '/history' => ['controller' => IWebHistoryController::class, 'action' => 'showGeneral'],
    '/session' => ['controller' => IWebHistoryController::class, 'action' => 'showPersonal'],
    '/accessDenied' => ['controller' => IAuthController::class, 'action' => 'accessDenied'],
    '/login' => ['controller' => IAuthController::class, 'action' => 'login'],
];
