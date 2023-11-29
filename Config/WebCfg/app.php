<?php

return [
    'homeUrl' => '/',
    'authEnabled' => true,
    'authSessionLifeTime' => 900,
    'authWhitelist' => require __DIR__ . '/authWhitelist.php',
    'routes' => require __DIR__ . '/webRoutes.php',
];
