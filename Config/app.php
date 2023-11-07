<?php

return [
    'homeUrl' => '/',
    'routes' => require __DIR__ . '/../Config/routes.php',
    'authEnabled' => true,
    'authSessionLifeTime' => 300,
    'authWhitelist' => require __DIR__ . '/../Config/authWhitelist.php',
];
