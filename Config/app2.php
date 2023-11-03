<?php

return [
    'homeUrl' => '123',
    'routes' => require('../Config/routes.php'),
    'authEnabled' => true,
    'authSessionLifeTime' => 300,
    'authWhitelist' => require('../Config/authWhitelist.php'),
];
