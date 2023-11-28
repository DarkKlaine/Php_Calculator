<?php

$config = require __DIR__ . '/modules.php';
$modulesPath = $config['modulesPath'];
$modulesList = $config['modulesList'];
$moduleDepsPath = '/Config/container.di.php';

$dependencies = [];

foreach ($modulesList as $module) {
    $dependencyFile = $modulesPath . $module . $moduleDepsPath;
    if (file_exists($dependencyFile)) {
        $dependencies = array_merge($dependencies, require $dependencyFile);
    }
}

return array_merge(
    require __DIR__ . '/../Engine/Services/Container/engine.di.php',
    $dependencies
);