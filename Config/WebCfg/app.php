<?php

return [
    'homeUrl' => '/',
    'authEnabled' => true,
    'authSessionLifeTime' => 3600,
    'authWhitelist' => require __DIR__ . '/authWhitelist.php',
    'routes' => require __DIR__ . '/webRoutes.php',
];
