<?php

return [
    'homeUrl' => '/',
    'routes' => require __DIR__ . '/webRoutes.php',
    'authEnabled' => false,
    'authSessionLifeTime' => 300,
    'authWhitelist' => require __DIR__ . '/authWhitelist.php',
];
