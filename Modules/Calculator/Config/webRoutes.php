<?php

use Modules\Calculator\Controllers\WebControllers\IWebCalculatorController;
use Modules\Calculator\Controllers\WebControllers\WebHistoryController;

return [
    'Calculator' => [
        'url' => '/calculator',
        'action' => [IWebCalculatorController::class, 'showForm']
    ],
    'Calculate' => [
        'url' => '/calculator/calculate',
        'action' => [IWebCalculatorController::class, 'calculate']
    ],
    'AllHistory' => [
        'url' => '/calculator/history',
        'action' => [WebHistoryController::class, 'showHistory']
    ],
    'UserHistory' => [
        'url' => '/calculator/history/user',
        'action' => [WebHistoryController::class, 'showUserHistory']
    ],
    'GlobalHistory' => [
        'url' => '/calculator/history/global',
        'action' => [WebHistoryController::class, 'showGeneral']
    ],
    'SessionHistory' => [
        'url' => '/calculator/history/session',
        'action' => [WebHistoryController::class, 'showPersonal']
    ],
    'DataBaseHistory' => [
        'url' => '/calculator/history/database',
        'action' => [WebHistoryController::class, 'showDB']
    ],
];
