<?php

return array_merge(
    //Auth routes
    require __DIR__ . '/authRoutes.php',
    // Modules/Calculator routes
    require __DIR__ . '/../../Modules/Calculator/Config/Routes/webRoutes.php',
    // Modules/UsersCRUD routes
    require __DIR__ . '/../../Modules/UsersCRUD/Config/Routes/webRoutes.php',
);
