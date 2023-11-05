<?php

use Engine\App\Application;
use Engine\App\Container\Container;
use Engine\App\DTO\ConfigDTO;
use Engine\App\Interfaces\AuthSessionHandler;
use Engine\App\Interfaces\RedirectHandler;
use Engine\App\Models\Logger\EngineLogger;
use Engine\App\Router;

require_once('../vendor/autoload.php');
$configDTO = new ConfigDTO(require_once('../Config/app.php'));

$container = new Container();

$container->set('RedirectHandler', function () {
    return new RedirectHandler();
});

$container->set('AuthSessionHandler', function () {
    return new AuthSessionHandler();
});

$container->set('Logger', function () {
    return new EngineLogger();
});

$container->set('Router', function (Container $container) {
    $logger = $container->get('Logger');
    $routes = ConfigDTO::$routes;
    return new Router($logger, $routes);
});

$container->set('Application', function (Container $container) {
    $router = $container->get('Router');
    return new Application($router);
});

$app = $container->get('Application');
$app->run();
