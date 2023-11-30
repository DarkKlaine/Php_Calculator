<?php

namespace Modules\User\Controllers;

use Engine\Services\Routers\WebRouter\WebRequestDTO;
use Modules\User\IUserConfigManagerWeb;
use Modules\User\Views\UserManagerView;
use Modules\User\Views\UserRegisterPasswordView;
use Modules\User\Views\UserRegisterRoleView;
use Modules\User\Views\UserRegisterUsernameView;

class UserController
{
    private IUserConfigManagerWeb $configManagerWeb;
    private UserManagerView $userManagerView;
    private UserRegisterUsernameView $registerUsernameView;
    private UserRegisterPasswordView $registerPasswordView;
    private UserRegisterRoleView $registerRoleView;

    public function __construct(
        IUserConfigManagerWeb $configManagerWeb,
        UserManagerView $userManagerView,
        UserRegisterUsernameView $registerUsernameView,
        UserRegisterPasswordView $registerPasswordView,
        UserRegisterRoleView $registerRoleView,
    )
    {

        $this->configManagerWeb = $configManagerWeb;
        $this->userManagerView = $userManagerView;
        $this->registerUsernameView = $registerUsernameView;
        $this->registerPasswordView = $registerPasswordView;
        $this->registerRoleView = $registerRoleView;
    }

    public function userManager(WebRequestDTO $request): void
    {
        $this->userManagerView->render();
    }

    public function setUsername(WebRequestDTO $request): void
    {
        // TODO: Implement setUsername() method.
    }

    public function setPassword(WebRequestDTO $request): void
    {
        // TODO: Implement setPassword() method.
    }

    public function setRole(WebRequestDTO $request): void
    {
        // TODO: Implement setRole() method.
    }

    public function showUsersList(WebRequestDTO $request): void
    {
        // TODO: Implement showUsersList() method.
    }

    public function showUserInfo(WebRequestDTO $request): void
    {
        // TODO: Implement showUserInfo() method.
    }
}