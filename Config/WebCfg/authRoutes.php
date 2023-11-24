<?php

use Engine\Services\Routers\WebRouter\IAuthController;

return [
    '/accessDenied' => ['controller' => IAuthController::class, 'action' => 'accessDenied'],
    '/login' => ['controller' => IAuthController::class, 'action' => 'login'],
];
