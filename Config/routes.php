<?php

use App\Controllers\CalculatorController;
use App\Controllers\GeneralHistoryController;
use App\Controllers\SessionHistoryController;
use App\Controllers\UIController;

$routes = [
    '/' => UIController::class,
    '/history' => GeneralHistoryController::class,
    '/session' => SessionHistoryController::class,
    '/calculate' => CalculatorController::class,
];