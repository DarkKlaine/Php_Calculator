<?php

use Modules\Calculator\Controllers\WebControllers\WebCalculatorController;
use Modules\Calculator\Controllers\WebControllers\WebHistoryController;

return [
    'Calculator' => [
        'url' => '/calculator',
        'action' => [WebCalculatorController::class, 'showForm']
    ],
    'Calculate' => [
        'url' => '/calculator/calculate',
        'action' => [WebCalculatorController::class, 'calculate']
    ],
    'AllHistory' => [
        'url' => '/calculator/history',
        'action' => [WebHistoryController::class, 'showHistory']
    ],
    'UserHistory' => [
        'url' => '/calculator/history/user',
        'action' => [WebHistoryController::class, 'showUserHistory']
    ],
];
