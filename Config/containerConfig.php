<?php

use Engine\Application;
use Engine\Container\Container;
use Engine\DTO\ConfigDTO;
use Engine\Interfaces\AuthSessionHandler;
use Engine\Interfaces\RedirectHandler;
use Engine\Models\Logger\EngineLogger;
use Engine\Router;

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
