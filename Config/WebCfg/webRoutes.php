<?php


return array_merge(
    //Auth routes
    require __DIR__ . '/authRoutes.php',
    // Module/Calculator routes
    require __DIR__ . '/../../Modules/Calculator/Config/Routes/webRoutes.php',
);
