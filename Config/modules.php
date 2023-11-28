<?php

return [
    'modulesList' => [
        'Calculator',
        'User',
    ],
    'modulesPath' => __DIR__ . '/../Modules/',
];


/** BaseCfgManager
 должен собрать роуты движка и модулей в кучу, и назначить в свойство (получаем через геттер)
 должен собрать в свойства конфиги движка (получаем через геттер)
 ModuleCfgManager
 должен наследоваться от BaseCfgManager
 должен собрать в свойства конфиги модуля*/

/**
 * Файловая архитектура
 * Config
 *    - engineApp.php
 *      - homeUrl
 *      - authModuleName
 *      - authEnabled - тут или в модуле?
 *      - require __DIR__ . '/modules.php'
 *      - require __DIR__ . '/dbConnection.php'
 *    - engineWebRotes.php - главная страница движка со ссылками на модули, возможно перенаправление на страницу модуля
 *    - engineConsoleRoutes.php - например php dk
 *    - engineDeps.php
 *    - modules.php
 *    - dbConnection.php
 * Module
 * - Config
 *   - app.php - какие-то уникальные для модуля конфиги, возможно веб и консоль версии
 *   - webRotes.php
 *   - consoleRoutes.php
 *   - containerDeps.php
 *
 */

//http 403
//glob
//*.di.php
//*.routes.php

/**

$config = require __DIR__ . '/modules.php';
$modulesPath = $config['modulesPath'];
$modulesList = $config['modulesList'];
$moduleDepsPath = '/Config/container.di.php;

$dependencies = [];

foreach ($modulesList as $module) {
    $dependencyFile = $modulesPath . $module . $moduleDepsPath;
    if (file_exists($dependencyFile)) {
        $dependencies = array_merge($dependencies, require $dependencyFile);
    }
}

return array_merge(
    require __DIR__ . '/engine.di.php',
    $dependencies
);

 */
