<?php

use Engine\Controllers\AuthControllerWeb;
use Engine\Controllers\IAccessDeniedView;
use Engine\Controllers\ILoginView;
use Engine\Models\Auth;
use Engine\Models\IAuthSessionHandler;
use Engine\Services\ConfigManagers\ConsoleConfigManager;
use Engine\Services\ConfigManagers\WebConfigManager;
use Engine\Services\Container\Container;
use Engine\Services\Logger\EngineLogger;
use Engine\Services\Routers\ConsoleRouter\ConsoleRouter;
use Engine\Services\Routers\ConsoleRouter\IConsoleConfigManager;
use Engine\Services\Routers\WebRouter\IAuth;
use Engine\Services\Routers\WebRouter\IAuthController;
use Engine\Services\Routers\WebRouter\IWebConfigManager;
use Engine\Services\Routers\WebRouter\IWebRedirectHandler;
use Engine\Services\Routers\WebRouter\WebRedirectHandler;
use Engine\Services\Routers\WebRouter\WebRouter;
use Engine\Services\SessionHandler\AuthSessionHandler;
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
        $users = require(__DIR__ . '/../../../Config/WebCfg/users.php');
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
        return new AuthControllerWeb($redirectHandler, $logger, $configManager, $accessDeniedView, $auth, $loginView,);
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
    WebRouter::class => function (Container $container) {
        $logger = $container->get(LoggerInterface::class);
        $configManager = $container->get(IWebConfigManager::class);
        $auth = $container->get(IAuth::class);
        return new WebRouter($logger, $configManager, $auth, $container);
    },
    IWebConfigManager::class => function () {
        $appConfig = require(__DIR__ . '/../../../Config/WebCfg/app.php');
        return new WebConfigManager($appConfig);
    },
    //Console
    ConsoleRouter::class => function (Container $container) {
        $logger = $container->get(LoggerInterface::class);
        $configManager = $container->get(IConsoleConfigManager::class);
        return new ConsoleRouter($logger, $configManager, $container);
    },
    IConsoleConfigManager::class => function () {
        $appConfig = require(__DIR__ . '/../../../Config/ConsoleCfg/app.php');
        return new ConsoleConfigManager($appConfig);
    },
];
