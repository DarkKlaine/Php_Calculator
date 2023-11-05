<?php

use Engine\Application;
use Engine\Container\Container;
use Engine\Controllers\AuthController;
use Engine\Controllers\BaseController;
use Engine\DTO\ConfigDTO;
use Engine\Interfaces\AuthSessionHandler;
use Engine\Interfaces\RedirectHandler;
use Engine\Models\Auth;
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

$container->set('Auth', function (Container $container) {
    $redirectHandler = $container->get('RedirectHandler');
    $authSessionHandler = $container->get('AuthSessionHandler');
    $users = require('../Config/users.php');
    return new Auth($redirectHandler, $authSessionHandler, $users);
});

$container->set('AuthController', function ($container) {
    $auth = $container->get('Auth');
    return new AuthController($auth);
});

$container->set('Router', function (Container $container) {
    $logger = $container->get('Logger');
    $routes = ConfigDTO::$routes;
    $auth = $container->get('Auth');
    return new Router($logger, $routes, $auth);
});

$container->set('Application', function (Container $container) {
    $router = $container->get('Router');
    return new Application($router);
});

$container->set('BaseController', function (Container $container) {
    return new BaseController($container);
});
