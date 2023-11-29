<?php

use Engine\Controllers\IEngineControllerWeb;
use Engine\Services\Routers\WebRouter\IAuthController;

return [
    'EngineHome' => [
        'url' => '/',
        'controller' => IEngineControllerWeb::class,
        'action' => 'engineHomePage'
    ],
    'AccessDenied' => [
        'url' => '/accessDenied',
        'controller' => IAuthController::class,
        'action' => 'accessDenied'
    ],
    'Login' => [
        'url' => '/login',
        'controller' => IAuthController::class,
        'action' => 'login'
    ],
];
