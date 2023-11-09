<?php

return [
    'homeUrl' => '/',
    'routes' => require __DIR__ . '/webRoutes.php',
    'authEnabled' => true,
    'authSessionLifeTime' => 300,
    'authWhitelist' => require __DIR__ . '/authWhitelist.php',
];
