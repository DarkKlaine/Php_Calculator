<?php

use Engine\Services\Routers\WebRouter\IAuthController;

return [
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
