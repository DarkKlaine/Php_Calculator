<?php

use Modules\Calculator\Controllers\WebControllers\IWebCalculatorController;
use Modules\Calculator\Controllers\WebControllers\IWebHistoryController;

return [
    'Calculator' => [
        'url' => '/calculator',
        'action' => [IWebCalculatorController::class, 'showForm']
    ],
    'Calculate' => [
        'url' => '/calculator/calculate',
        'action' => [IWebCalculatorController::class, 'calculate']
    ],
    'GlobalHistory' => [
        'url' => '/calculator/history/global',
        'action' => [IWebHistoryController::class, 'showGeneral']
    ],
    'SessionHistory' => [
        'url' => '/calculator/history/session',
        'action' => [IWebHistoryController::class, 'showPersonal']
    ],
    'DataBaseHistory' => [
        'url' => '/calculator/history/database',
        'action' => [IWebHistoryController::class, 'showDB']
    ],
];
