<?php


use Engine\Services\Container\Container;
use Engine\Views\IWebTemplateEngine;
use Modules\User\Controllers\UserController;
use Modules\User\IUserConfigManagerWeb;
use Modules\User\Services\ConfigManager\UserConfigManagerWeb;
use Modules\User\Views\UserManagerView;
use Modules\User\Views\UserRegisterPasswordView;
use Modules\User\Views\UserRegisterRoleView;
use Modules\User\Views\UserRegisterUsernameView;

return [
    //Shared

    //Web
    IUserConfigManagerWeb::class => function () {
        $appConfig = require(__DIR__ . '/../../../Config/WebCfg/app.php');
        return new UserConfigManagerWeb($appConfig);
    },
    UserController::class => function (Container $container) {
        return new UserController(
            $container->get(IUserConfigManagerWeb::class),
            $container->get(UserManagerView::class),
            $container->get(UserRegisterUsernameView::class),
            $container->get(UserRegisterPasswordView::class),
            $container->get(UserRegisterRoleView::class),
        );
    },
    UserManagerView::class => function ($container) {
        return new UserManagerView(
            $container->get(IWebTemplateEngine::class),
        );
    },
    UserRegisterUsernameView::class => function ($container) {
        return new UserRegisterUsernameView(
            $container->get(IWebTemplateEngine::class),
            $container->get(IUserConfigManagerWeb::class),
        );
    },
    UserRegisterPasswordView::class => function ($container) {
        return new UserRegisterPasswordView(
            $container->get(IWebTemplateEngine::class),
        );
    },
    UserRegisterRoleView::class => function ($container) {
        return new UserRegisterRoleView(
            $container->get(IWebTemplateEngine::class),
        );
    },
    //Console

];
