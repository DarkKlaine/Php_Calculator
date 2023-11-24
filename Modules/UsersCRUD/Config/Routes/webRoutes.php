<?php

use Modules\UsersCRUD\Controllers\IUsersController;

return [
    '/users/register/username' => ['controller' => IUsersController::class, 'action' => 'setUsername'],
    '/users/register/password' => ['controller' => IUsersController::class, 'action' => 'setPassword'],
    '/users/register/role' => ['controller' => IUsersController::class, 'action' => 'setRole'],
    '/users/list' => ['controller' => IUsersController::class, 'action' => 'showUsersList'],
    '/users/userinfo' => ['controller' => IUsersController::class, 'action' => 'showUserInfo'],
];
