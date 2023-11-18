<?php

return array_merge(
    //Auth routes
    require_once __DIR__ . '/authRoutes.php',
    // Module/Calculator routes
    require_once __DIR__ . '/../Modules/Calculator/Config/Routes/webRoutes.php',
);
