<?php

return [
    'homeUrl' => '/',
    'routes' => require_once('../Config/routes.php'),
    'authEnabled' => false,
    'authSessionLifeTime' => 300000,
    'authWhitelist' => require_once ('../Config/authWhitelist.php'),

];
