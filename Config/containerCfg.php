<?php

return array_merge(
    require __DIR__ . '/../Engine/Services/Container/engineDependencies.php',
    require __DIR__ . '/../Modules/Calculator/Config/Container/containerDependencies.php',
);
