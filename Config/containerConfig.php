<?php

use Engine\Application;
use Engine\Container\Container;
use Engine\Controllers\AuthController;
use Engine\DTO\ConfigDTO;
use Engine\Interfaces\AuthSessionHandler;
use Engine\Interfaces\RedirectHandler;
use Engine\Models\Auth;
use Engine\Models\Logger\EngineLogger;
use Engine\Router;
use Modules\Calculator\CalculatorController;
use Modules\Calculator\HistoryController;

$container = new Container();

$container->set(RedirectHandler::class, function () {
    return new RedirectHandler();
});

$container->set(AuthSessionHandler::class, function () {
    return new AuthSessionHandler();
});

$container->set(EngineLogger::class, function () {
    return new EngineLogger();
});

$container->set(Auth::class, function (Container $container) {
    $redirectHandler = $container->get(RedirectHandler::class);
    $authSessionHandler = $container->get(AuthSessionHandler::class);
    $users = require('../Config/users.php');
    return new Auth($redirectHandler, $authSessionHandler, $users);
});

$container->set(AuthController::class, function (Container $container) {
    return new AuthController($container);
});

$container->set(Router::class, function (Container $container) {
    $logger = $container->get(EngineLogger::class);
    $routes = ConfigDTO::$routes;
    $auth = $container->get(Auth::class);
    return new Router($logger, $routes, $auth, $container);
});

$container->set(Application::class, function (Container $container) {
    $router = $container->get(Router::class);
    return new Application($router);
});

$container->set(CalculatorController::class, function (Container $container) {
    return new CalculatorController($container);
});

$container->set(HistoryController::class, function (Container $container) {
    return new HistoryController($container);
});