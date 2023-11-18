<?php

return [
    'homeUrl' => '/',
    'authEnabled' => false,
    'authSessionLifeTime' => 300,
    'authWhitelist' => require __DIR__ . '/authWhitelist.php',
    'routes' => require __DIR__ . '/webRoutes.php',
];
