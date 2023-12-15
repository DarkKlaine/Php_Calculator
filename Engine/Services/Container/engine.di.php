<?php

use App\UserStorage;
use Engine\Controllers\AuthControllerWeb;
use Engine\Controllers\EngineControllerWeb;
use Engine\Controllers\IEngineControllerWeb;
use Engine\Controllers\ILoginView;
use Engine\Models\Auth;
use Engine\Models\IAuthStorage;
use Engine\Models\IAuthSessionHandler;
use Engine\Services\ConfigManagers\AuthConfigManagerWeb;
use Engine\Services\ConfigManagers\BaseConfigManagerConsole;
use Engine\Services\ConfigManagers\BaseConfigManagerWeb;
use Engine\Services\ConfigManagers\IAuthConfigManagerWeb;
use Engine\Services\Container\Container;
use Engine\Services\DBConnector\DBConnection;
use Engine\Services\DBConnector\IDBConnection;
use Engine\Services\ErrorHandler\ErrorHandler;
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
use Engine\Views\Page403View;
use Engine\Views\EngineHomePageView;
use Engine\Views\IWebTemplateEngine;
use Engine\Views\LoginView;
use Engine\Views\Page404View;
use Engine\Views\Page500View;
use Engine\Views\WebTemplateEngine;
use Psr\Log\LoggerInterface;

return [
    //Shared
    LoggerInterface::class => function () {
        return new EngineLogger();
    },
    IDBConnection::class => function (Container $container) {
        $dbConnection = require(__DIR__ . '/../../../Config/dbConnection.php');

        return new DBConnection(
            $container->get(LoggerInterface::class),
            $dbConnection['host'],
            $dbConnection['username'],
            $dbConnection['password'],
            $dbConnection['dbname']
        );
    },
    //Auth
    IAuthConfigManagerWeb::class => function () {
        $appConfig = require(__DIR__ . '/../../../Config/WebCfg/app.php');

        return new AuthConfigManagerWeb($appConfig);
    },
    IAuthSessionHandler::class => function () {
        return new AuthSessionHandler();
    },
    IAuthStorage::class => function (Container $container) {
        return new UserStorage(
            $container->get(LoggerInterface::class), $container->get(IDBConnection::class),
        );
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
            $container->get(IAuthStorage::class),
        );
    },
    IAuthController::class => function (Container $container) {
        return new AuthControllerWeb(
            $container->get(Page403View::class),
            $container->get(IAuth::class),
            $container->get(ILoginView::class),
        );
    },
    Page403View::class => function ($container) {
        return new Page403View($container->get(IWebTemplateEngine::class));
    },
    Page404View::class => function ($container) {
        return new Page404View($container->get(IWebTemplateEngine::class));
    },
    Page500View::class => function ($container) {
        return new Page500View($container->get(IWebTemplateEngine::class));
    },
    ILoginView::class => function ($container) {
        return new LoginView($container->get(IWebTemplateEngine::class));
    },
    //Web
    IEngineControllerWeb::class => function (Container $container) {
        return new EngineControllerWeb(
            $container->get(EngineHomePageView::class),
            $container->get(IAuthSessionHandler::class),
        );
    },
    EngineHomePageView::class => function ($container) {
        return new EngineHomePageView(
            $container->get(IWebTemplateEngine::class),
            $container->get(IAuthSessionHandler::class),
        );
    },
    ErrorHandler::class => function ($container) {
        return new ErrorHandler(
            $container->get(LoggerInterface::class),
            $container->get(Page403View::class),
            $container->get(Page404View::class),
            $container->get(Page500View::class),
        );
    },
    IWebRedirectHandler::class => function () {
        return new WebRedirectHandler();
    },
    IWebTemplateEngine::class => function () {
        return new WebTemplateEngine();
    },
    WebRouter::class => function (Container $container) {
        return new WebRouter(
            $container->get(LoggerInterface::class),
            $container->get(IAuthConfigManagerWeb::class),
            $container->get(IAuth::class),
            $container,
            $container->get(IWebRedirectHandler::class),
            $container->get(ErrorHandler::class)
        );
    },
    IWebConfigManager::class => function () {
        $appConfig = require(__DIR__ . '/../../../Config/WebCfg/app.php');

        return new BaseConfigManagerWeb($appConfig);
    },
    //Console
    ConsoleRouter::class => function (Container $container) {
        return new ConsoleRouter(
            $container->get(LoggerInterface::class),
            $container->get(IConsoleConfigManager::class),
            $container
        );
    },
    IConsoleConfigManager::class => function () {
        $appConfig = require(__DIR__ . '/../../../Config/ConsoleCfg/app.php');

        return new BaseConfigManagerConsole($appConfig);
    },
];
