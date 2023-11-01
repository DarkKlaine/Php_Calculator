<?php

return [
    'homeUrl' => '/',
    'routes' => require_once('../Config/routes.php'),
    'authEnabled' => false,
    'authWhitelist' => require_once ('../Config/authWhitelist.php'),

];
