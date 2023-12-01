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
        'url' => '/user/register/password',
        'action' => [UserController::class, 'setPassword'],
    ],
    'SetRole' => [
        'url' => '/user/register/role',
        'action' => [UserController::class, 'setRole'],
    ],
    'ShowUsersList' => [
        'url' => '/user/list',
        'action' => [UserController::class, 'showUsersList'],
    ],
    'ShowUserInfo' => [
        'url' => '/user/userinfo',
        'action' => [UserController::class, 'showUserInfo'],
    ],
];
