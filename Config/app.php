<?php

return [
    'homeUrl' => '/',
    'routes' => require_once('../Config/routes.php'),
    'authEnabled' => true,
    'authSessionLifeTime' => 300,
    'authWhitelist' => require_once('../Config/authWhitelist.php'),
];
