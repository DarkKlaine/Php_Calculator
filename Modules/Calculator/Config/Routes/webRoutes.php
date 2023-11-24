<?php

use Modules\Calculator\Controllers\WebControllers\IWebCalculatorController;
use Modules\Calculator\Controllers\WebControllers\IWebHistoryController;

return [
    '/calculator' => ['controller' => IWebCalculatorController::class, 'action' => 'showForm'],
    '/calculate' => ['controller' => IWebCalculatorController::class, 'action' => 'calculate'],
    '/history' => ['controller' => IWebHistoryController::class, 'action' => 'showGeneral'],
    '/session' => ['controller' => IWebHistoryController::class, 'action' => 'showPersonal'],
    '/db' => ['controller' => IWebHistoryController::class, 'action' => 'showDB'],
];
