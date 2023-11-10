<?php

use Engine\Controllers\AuthController;
use Engine\Controllers\IAccessDeniedView;
use Engine\Controllers\ILoginView;
use Engine\IConsoleRouter;
use Engine\IWebRouter;
use Engine\Models\Auth;
use Engine\Models\IAuthSessionHandler;
use Engine\Router\ConsoleRouter;
use Engine\Router\IAuth;
use Engine\Router\IAuthController;
use Engine\Router\IConsoleConfigManager;
use Engine\Router\IWebConfigManager;
use Engine\Router\IWebRedirectHandler;
use Engine\Router\WebRedirectHandler;
use Engine\Router\WebRouter;
use Engine\Services\AuthSessionHandler;
use Engine\Services\ConsoleConfigManager;
use Engine\Services\Container\Container;
use Engine\Services\Logger\EngineLogger;
use Engine\Services\WebConfigManager;
use Engine\Views\AccessDeniedView;
use Engine\Views\IWebTemplateEngine;
use Engine\Views\LoginView;
use Engine\Views\WebTemplateEngine;
use Psr\Log\LoggerInterface;

return [
    //Shared
    LoggerInterface::class => function () {
        return new EngineLogger();
    },
    //Auth
    IAuthSessionHandler::class => function () {
        return new AuthSessionHandler();
    },
    IAuth::class => function (Container $container) {
        $users = require(__DIR__ . '/../WebCfg/users.php');
        $redirectHandler = $container->get(IWebRedirectHandler::class);
        $authSessionHandler = $container->get(IAuthSessionHandler::class);
        $configManager = $container->get(IWebConfigManager::class);
        return new Auth($users, $redirectHandler, $authSessionHandler, $configManager,);
    },
    IAuthController::class => function (Container $container) {
        $redirectHandler = $container->get(IWebRedirectHandler::class);
        $logger = $container->get(LoggerInterface::class);
        $configManager = $container->get(IWebConfigManager::class);
        $accessDeniedView = $container->get(IAccessDeniedView::class);
        $auth = $container->get(IAuth::class);
        $loginView = $container->get(ILoginView::class);
        return new AuthController($redirectHandler, $logger, $configManager, $accessDeniedView, $auth, $loginView,);
    },
    IAccessDeniedView::class => function ($container) {
        $templateEngine = $container->get(IWebTemplateEngine::class);
        return new AccessDeniedView($templateEngine);
    },
    ILoginView::class => function ($container) {
        $templateEngine = $container->get(IWebTemplateEngine::class);
        return new LoginView($templateEngine);
    },
    //Web
    IWebRedirectHandler::class => function () {
        return new WebRedirectHandler();
    },
    IWebTemplateEngine::class => function () {
        return new WebTemplateEngine();
    },
    IWebRouter::class => function (Container $container) {
        $logger = $container->get(LoggerInterface::class);
        $configManager = $container->get(IWebConfigManager::class);
        $auth = $container->get(IAuth::class);
        return new WebRouter($logger, $configManager, $auth, $container);
    },
    IWebConfigManager::class => function () {
        $appConfig = require(__DIR__ . '/../WebCfg/app.php');
        return new WebConfigManager($appConfig);
    },
    //Console
    IConsoleRouter::class => function (Container $container) {
        $logger = $container->get(LoggerInterface::class);
        $configManager = $container->get(IConsoleConfigManager::class);
        return new ConsoleRouter($logger, $configManager, $container);
    },
    IConsoleConfigManager::class => function () {
        $appConfig = require(__DIR__ . '/../ConsoleCfg/app.php');
        return new ConsoleConfigManager($appConfig);
    },
];
