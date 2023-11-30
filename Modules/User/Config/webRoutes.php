<?php

use Modules\User\Controllers\UserController;

return [
    'UserManager' => [
        'url' => '/user',
        'action' => [UserController::class, 'userManager'],
    ],
    'SetUsername' => [
        'url' => '/user/register/username',
        'action' => [UserController::class, 'setUsername'],
    ],
    'SetPassword' => [
        '/user/register/password',
        'action' => [UserController::class, 'setPassword'],
    ],
    'SetRole' => [
        '/user/register/role',
        'action' => [UserController::class, 'setRole'],
    ],
    'ShowUsersList' => [
        '/user/list',
        'action' => [UserController::class, 'showUsersList'],
    ],
    'ShowUserInfo' => [
        '/user/userinfo',
        'action' => [UserController::class, 'showUserInfo'],
    ],
];
