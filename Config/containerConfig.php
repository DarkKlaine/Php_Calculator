<?php

use Engine\Container\Container;
use Engine\Controllers\AuthController;
use Engine\DTO\ConfigManager;
use Engine\Interfaces\AuthSessionHandler;
use Engine\Interfaces\RedirectHandler;
use Engine\Models\Auth;
use Engine\Models\Logger\EngineLogger;
use Engine\Router;
use Engine\Views\AccessDeniedView;
use Engine\Views\LoginView;
use Engine\Views\TemplateEngine;
use Modules\Calculator\CalculatorController;
use Modules\Calculator\CalculatorView;
use Modules\Calculator\Computations\Addition;
use Modules\Calculator\Computations\Divide;
use Modules\Calculator\Computations\Exponentiation;
use Modules\Calculator\Computations\Multiply;
use Modules\Calculator\Computations\SinCosTan;
use Modules\Calculator\Computations\Subtraction;
use Modules\Calculator\HistoryController;
use Modules\Calculator\HistoryModel;
use Modules\Calculator\HistoryView;

return [
    RedirectHandler::class => function () {
        return new RedirectHandler();
    },
    TemplateEngine::class => function () {
        return new TemplateEngine();
    },
    AuthSessionHandler::class => function () {
        return new AuthSessionHandler();
    },
    EngineLogger::class => function () {
        return new EngineLogger();
    },
    HistoryModel::class => function () {
        return new HistoryModel();
    },
    Auth::class => function (Container $container) {
        $users = require('../Config/users.php');
        return new Auth($users, $container);
    },
    AuthController::class => function (Container $container) {
        return new AuthController($container);
    },
    Router::class => function (Container $container) {
        return new Router($container);
    },
    CalculatorController::class => function (Container $container) {
        return new CalculatorController($container);
    },
    HistoryController::class => function (Container $container) {
        return new HistoryController($container);
    },
    ConfigManager::class => function () {
        $appConfig = require('../Config/app.php');
        return new ConfigManager($appConfig);
    },
    AccessDeniedView::class => function ($container) {
        return new AccessDeniedView($container);
    },
    LoginView::class => function ($container) {
        return new LoginView($container);
    },
    HistoryView::class => function ($container) {
        return new HistoryView($container);
    },
    CalculatorView::class => function ($container) {
        return new CalculatorView($container);
    },
    Addition::class => function ($container) {
        return new Addition($container);
    },
    Subtraction::class => function ($container) {
        return new Subtraction($container);
    },
    Multiply::class => function ($container) {
        return new Multiply($container);
    },
    Divide::class => function ($container) {
        return new Divide($container);
    },
    Exponentiation::class => function ($container) {
        return new Exponentiation($container);
    },
    SinCosTan::class => function ($container) {
        return new SinCosTan($container);
    },
];
