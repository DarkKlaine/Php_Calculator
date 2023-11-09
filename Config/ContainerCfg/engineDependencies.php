<?php

use Engine\Container\Container;
use Engine\Controllers\AuthController;
use Engine\Controllers\IAccessDeniedView;
use Engine\Controllers\ILoginView;
use Engine\IConsoleRouter;
use Engine\IWebRouter;
use Engine\Models\Auth;
use Engine\Models\IAuthSessionHandler;
use Engine\Models\Logger\EngineLogger;
use Engine\Router\ConsoleRouter;
use Engine\Router\IAuth;
use Engine\Router\IAuthController;
use Engine\Router\IConsoleConfigManager;
use Engine\Router\IRedirectHandler;
use Engine\Router\IWebConfigManager;
use Engine\Router\RedirectHandler;
use Engine\Router\WebRouter;
use Engine\Services\AuthSessionHandler;
use Engine\Services\ConsoleConfigManager;
use Engine\Services\WebConfigManager;
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
        $users = require(__DIR__ . '/../WebCfg/users.php');
        $redirectHandler = $container->get(IRedirectHandler::class);
        $authSessionHandler = $container->get(IAuthSessionHandler::class);
        $configManager = $container->get(IWebConfigManager::class);
        return new Auth($users, $redirectHandler, $authSessionHandler, $configManager,);
    },
    IAuthController::class => function (Container $container) {
        $redirectHandler = $container->get(IRedirectHandler::class);
        $logger = $container->get(LoggerInterface::class);
        $configManager = $container->get(IWebConfigManager::class);
        $accessDeniedView = $container->get(IAccessDeniedView::class);
        $auth = $container->get(IAuth::class);
        $loginView = $container->get(ILoginView::class);
        return new AuthController($redirectHandler, $logger, $configManager, $accessDeniedView, $auth, $loginView,);
    },
    IWebRouter::class => function (Container $container) {
        $logger = $container->get(LoggerInterface::class);
        $configManager = $container->get(IWebConfigManager::class);
        $auth = $container->get(IAuth::class);
        return new WebRouter($logger, $configManager, $auth, $container);
    },
    IConsoleRouter::class => function (Container $container) {
        $logger = $container->get(LoggerInterface::class);
        $configManager = $container->get(IConsoleConfigManager::class);
        return new ConsoleRouter($logger, $configManager, $container);
    },
    IWebConfigManager::class => function () {
        $appConfig = require(__DIR__ . '/../WebCfg/app.php');
        return new WebConfigManager($appConfig);
    },
    IConsoleConfigManager::class => function () {
        $appConfig = require(__DIR__ . '/../ConsoleCfg/app.php');
        return new ConsoleConfigManager($appConfig);
    },
    IAccessDeniedView::class => function ($container) {
        $templateEngine = $container->get(ITemplateEngine::class);
        return new AccessDeniedView($templateEngine);
    },
    ILoginView::class => function ($container) {
        $templateEngine = $container->get(ITemplateEngine::class);
        return new LoginView($templateEngine);
    },
];
