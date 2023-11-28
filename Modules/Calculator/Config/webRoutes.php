<?php

use Modules\Calculator\Controllers\WebControllers\IWebCalculatorController;
use Modules\Calculator\Controllers\WebControllers\IWebHistoryController;

return [
    'Calculator' => [
        'url' => '/',
        'controller' => IWebCalculatorController::class,
        'action' => 'showForm'
    ],
    'Calculate' => [
        'url' => '/calculator/calculate',
        'controller' => IWebCalculatorController::class,
        'action' => 'calculate'
    ],
    'GlobalHistory' => [
        'url' => '/calculator/history',
        'controller' => IWebHistoryController::class,
        'action' => 'showGeneral'
    ],
    'SessionHistory' => [
        'url' => '/calculator/session',
        'controller' => IWebHistoryController::class,
        'action' => 'showPersonal'
    ],
    'DataBaseHistory' => [
        'url' => '/calculator/db',
        'controller' => IWebHistoryController::class,
        'action' => 'showDB'
    ],
];
