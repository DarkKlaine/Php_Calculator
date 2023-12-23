<?php

return [
    'pageAccessLevels' => [
        '/' => 0,
        '/accessDenied' => 0,
        '/login' => 0,
        '/calculator*' => 1,
        '/user*' => 100,
    ],
    'roleAccessLevels' => [
        'Администратор' => 100,
        'Счетовод' => 1,
    ]
];
