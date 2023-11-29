<?php

$config = require __DIR__ . '/../modules.php';
$modulesPath = $config['modulesPath'];
$modulesList = $config['modulesList'];
$moduleRoutesPath = '/Config/consoleRoutes.php';

$routes = [];

foreach ($modulesList as $module) {
    $dependencyFile = $modulesPath . $module . $moduleRoutesPath;
    if (file_exists($dependencyFile)) {
        $routes = array_merge($routes, require $dependencyFile);
    }
}

return array_merge(
    $routes
);
