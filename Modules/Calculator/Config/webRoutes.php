<?php

use Modules\Calculator\Controllers\WebControllers\IWebCalculatorController;
use Modules\Calculator\Controllers\WebControllers\IWebHistoryController;

return [
    'Calculator' => [
        'url' => '/calculator',
        'controller' => IWebCalculatorController::class,
        'action' => 'showForm'
    ],
    'Calculate' => [
        'url' => '/calculator/calculate',
        'controller' => IWebCalculatorController::class,
        'action' => 'calculate'
    ],
    'GlobalHistory' => [
        'url' => '/calculator/history/global',
        'controller' => IWebHistoryController::class,
        'action' => 'showGeneral'
    ],
    'SessionHistory' => [
        'url' => '/calculator/history/session',
        'controller' => IWebHistoryController::class,
        'action' => 'showPersonal'
    ],
    'DataBaseHistory' => [
        'url' => '/calculator/history/database',
        'controller' => IWebHistoryController::class,
        'action' => 'showDB'
    ],
];
