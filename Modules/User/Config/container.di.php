<?php

use App\UserStorage;
use Engine\Services\Container\Container;
use Engine\Services\DBConnector\IDBConnection;
use Engine\Services\RedirectHandler\IWebRedirectHandler;
use Engine\Views\IWebTemplateEngine;
use Modules\User\Controllers\IUserStorage;
use Modules\User\Controllers\UserController;
use Modules\User\IUserConfigManagerWeb;
use Modules\User\Services\ConfigManager\UserConfigManagerWeb;
use Modules\User\Views\UserDeleteView;
use Modules\User\Views\UserInfoView;
use Modules\User\Views\UserListView;
use Modules\User\Views\UserManagerView;
use Modules\User\Views\UserSetPasswordView;
use Modules\User\Views\UserSetRoleView;
use Modules\User\Views\UserSetUsernameView;
use Psr\Log\LoggerInterface;

return [
    //Shared

    //Web
    IUserConfigManagerWeb::class => function () {
        $appConfig = require(__DIR__ . '/../../../Config/WebCfg/app.php');

        return new UserConfigManagerWeb($appConfig);
    },
    UserController::class => function (Container $container) {
        return new UserController(
            $container->get(UserManagerView::class),
            $container->get(UserSetUsernameView::class),
            $container->get(UserSetPasswordView::class),
            $container->get(UserSetRoleView::class),
            $container->get(UserListView::class),
            $container->get(UserInfoView::class),
            $container->get(UserDeleteView::class),
            $container->get(IUserStorage::class),
            $container->get(IUserConfigManagerWeb::class),
            $container->get(IWebRedirectHandler::class),
        );
    },
    IUserStorage::class => function (Container $container) {
        return new UserStorage(
            $container->get(LoggerInterface::class), $container->get(IDBConnection::class),
        );
    },
    UserManagerView::class => function ($container) {
        return new UserManagerView(
            $container->get(IWebTemplateEngine::class), $container->get(IUserConfigManagerWeb::class),
        );
    },
    UserSetUsernameView::class => function ($container) {
        return new UserSetUsernameView(
            $container->get(IWebTemplateEngine::class), $container->get(IUserConfigManagerWeb::class),
        );
    },
    UserSetPasswordView::class => function ($container) {
        return new UserSetPasswordView(
            $container->get(IWebTemplateEngine::class), $container->get(IUserConfigManagerWeb::class),
        );
    },
    UserSetRoleView::class => function ($container) {
        return new UserSetRoleView(
            $container->get(IWebTemplateEngine::class), $container->get(IUserConfigManagerWeb::class),
        );
    },
    UserListView::class => function ($container) {
        return new UserListView(
            $container->get(IWebTemplateEngine::class), $container->get(IUserConfigManagerWeb::class),
        );
    },
    UserInfoView::class => function ($container) {
        return new UserInfoView(
            $container->get(IWebTemplateEngine::class), $container->get(IUserConfigManagerWeb::class),
        );
    },
    UserDeleteView::class => function ($container) {
        return new UserDeleteView(
            $container->get(IWebTemplateEngine::class), $container->get(IUserConfigManagerWeb::class),
        );
    },
    //Console

];
