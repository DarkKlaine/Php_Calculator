<?php

use Engine\Controllers\IEngineControllerWeb;
use Engine\Services\Routers\WebRouter\IAuthController;

return [
    'EngineHome' => [
        'url' => '/',
        'action' => [IEngineControllerWeb::class, 'engineHomePage']
    ],
    'AccessDenied' => [
        'url' => '/accessDenied',
        'action' => [IAuthController::class, 'accessDenied']
    ],
    'Login' => [
        'url' => '/login',
        'action' => [IAuthController::class, 'login']
    ],
];
