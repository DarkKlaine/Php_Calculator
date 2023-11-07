<?php

use Engine\Container\Container;
use Engine\Controllers\AuthController;
use Engine\Controllers\IAccessDeniedView;
use Engine\Controllers\ILoginView;
use Engine\DTO\ConfigManager;
use Engine\DTO\IConfigManager;
use Engine\IRouter;
use Engine\Models\Auth;
use Engine\Models\IAuthSessionHandler;
use Engine\Models\Logger\EngineLogger;
use Engine\Router\IAuth;
use Engine\Router\IAuthController;
use Engine\Router\IRedirectHandler;
use Engine\Router\RedirectHandler;
use Engine\Router\Router;
use Engine\Services\AuthSessionHandler;
use Engine\Views\AccessDeniedView;
use Engine\Views\ITemplateEngine;
use Engine\Views\LoginView;
use Engine\Views\TemplateEngine;
use Psr\Log\LoggerInterface;

return [
    IRedirectHandler::class => function () {
        return new RedirectHandler();
    },
    ITemplateEngine::class => function () {
        return new TemplateEngine();
    },
    IAuthSessionHandler::class => function () {
        return new AuthSessionHandler();
    },
    LoggerInterface::class => function () {
        return new EngineLogger();
    },
    IAuth::class => function (Container $container) {
        $users = require('../Config/users.php');
        return new Auth($users, $container);
    },
    IAuthController::class => function (Container $container) {
        return new AuthController($container);
    },
    IRouter::class => function (Container $container) {
        return new Router($container);
    },
    IConfigManager::class => function () {
        $appConfig = require('../Config/app.php');
        return new ConfigManager($appConfig);
    },
    IAccessDeniedView::class => function ($container) {
        return new AccessDeniedView($container);
    },
    ILoginView::class => function ($container) {
        return new LoginView($container);
    },
];
