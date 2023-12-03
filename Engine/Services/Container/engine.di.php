<?php

use Engine\Controllers\AuthControllerWeb;
use Engine\Controllers\EngineControllerWeb;
use Engine\Controllers\IAccessDeniedView;
use Engine\Controllers\IEngineControllerWeb;
use Engine\Controllers\ILoginView;
use Engine\Models\Auth;
use Engine\Models\IAuthSessionHandler;
use Engine\Services\ConfigManagers\AuthConfigManagerWeb;
use Engine\Services\ConfigManagers\BaseConfigManagerConsole;
use Engine\Services\ConfigManagers\BaseConfigManagerWeb;
use Engine\Services\ConfigManagers\IAuthConfigManagerWeb;
use Engine\Services\Container\Container;
use Engine\Services\DBConnector\DBConnection;
use Engine\Services\DBConnector\IDBConnection;
use Engine\Services\Logger\EngineLogger;
use Engine\Services\RedirectHandler\IWebRedirectHandler;
use Engine\Services\RedirectHandler\WebRedirectHandler;
use Engine\Services\Routers\ConsoleRouter\ConsoleRouter;
use Engine\Services\Routers\ConsoleRouter\IConsoleConfigManager;
use Engine\Services\Routers\WebRouter\IAuth;
use Engine\Services\Routers\WebRouter\IAuthController;
use Engine\Services\Routers\WebRouter\IWebConfigManager;
use Engine\Services\Routers\WebRouter\WebRouter;
use Engine\Services\SessionHandler\AuthSessionHandler;
use Engine\Views\AccessDeniedView;
use Engine\Views\EngineHomePageView;
use Engine\Views\IEngineHomePageView;
use Engine\Views\IWebTemplateEngine;
use Engine\Views\LoginView;
use Engine\Views\WebTemplateEngine;
use Psr\Log\LoggerInterface;

return [
    //Shared
    LoggerInterface::class => function () {
        return new EngineLogger();
    },
    IDBConnection::class => function (Container $container) {
        $dbConnection = require(__DIR__ . '/../../../Config/dbConnection.php');
        $host = $dbConnection['host'];
        $username = $dbConnection['username'];
        $password = $dbConnection['password'];
        $dbname = $dbConnection['dbname'];
        $logger = $container->get(LoggerInterface::class);

        return new DBConnection($logger, $host, $username, $password, $dbname);
    },
    //Auth
    IAuthConfigManagerWeb::class => function () {
        $appConfig = require(__DIR__ . '/../../../Config/WebCfg/app.php');

        return new AuthConfigManagerWeb($appConfig);
    },
    IAuthSessionHandler::class => function () {
        return new AuthSessionHandler();
    },
    IAuth::class => function (Container $container) {
        $pageAccessLevels = require(__DIR__ . '/../../../Config/WebCfg/pageAccessLevels.php');
        $userAccessLevels = require(__DIR__ . '/../../../Config/WebCfg/userAccessLevels.php');

        return new Auth(
            $pageAccessLevels,
            $userAccessLevels,
            $container->get(IWebRedirectHandler::class),
            $container->get(IAuthSessionHandler::class),
            $container->get(IAuthConfigManagerWeb::class),
            $container->get(LoggerInterface::class),
            $container->get(IDBConnection::class),
        );
    },
    IAuthController::class => function (Container $container) {
        $accessDeniedView = $container->get(IAccessDeniedView::class);
        $auth = $container->get(IAuth::class);
        $loginView = $container->get(ILoginView::class);

        return new AuthControllerWeb($accessDeniedView, $auth, $loginView,);
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
    IEngineControllerWeb::class => function (Container $container) {
        $engineHomePageView = $container->get(IEngineHomePageView::class);

        return new EngineControllerWeb($engineHomePageView);
    },
    IEngineHomePageView::class => function ($container) {
        $templateEngine = $container->get(IWebTemplateEngine::class);

        return new EngineHomePageView($templateEngine);
    },
    IWebRedirectHandler::class => function () {
        return new WebRedirectHandler();
    },
    IWebTemplateEngine::class => function () {
        return new WebTemplateEngine();
    },
    WebRouter::class => function (Container $container) {
        $logger = $container->get(LoggerInterface::class);
        $configManager = $container->get(IAuthConfigManagerWeb::class);
        $auth = $container->get(IAuth::class);
        $redirectHandler = $container->get(IWebRedirectHandler::class);

        return new WebRouter($logger, $configManager, $auth, $container, $redirectHandler);
    },
    IWebConfigManager::class => function () {
        $appConfig = require(__DIR__ . '/../../../Config/WebCfg/app.php');

        return new BaseConfigManagerWeb($appConfig);
    },
    //Console
    ConsoleRouter::class => function (Container $container) {
        $logger = $container->get(LoggerInterface::class);
        $configManager = $container->get(IConsoleConfigManager::class);

        return new ConsoleRouter($logger, $configManager, $container);
    },
    IConsoleConfigManager::class => function () {
        $appConfig = require(__DIR__ . '/../../../Config/ConsoleCfg/app.php');

        return new BaseConfigManagerConsole($appConfig);
    },
];
