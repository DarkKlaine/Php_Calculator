<?php

use Modules\User\Controllers\UserController;

return [
    'UserManager' => [
        'url' => '/user',
        'action' => [UserController::class, 'userManager'],
    ],
    'SetUsername' => [
        'url' => '/user/manage/username',
        'action' => [UserController::class, 'setUsername'],
    ],
    'SetPassword' => [
        'url' => '/user/manage/password',
        'action' => [UserController::class, 'setPassword'],
    ],
    'SetRole' => [
        'url' => '/user/manage/role',
        'action' => [UserController::class, 'setRole'],
    ],
    'RecordUserData' => [
        'url' => '/user/manage/record',
        'action' => [UserController::class, 'recordUserData'],
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
