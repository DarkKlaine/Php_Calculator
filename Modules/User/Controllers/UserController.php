<?php

namespace Modules\User\Controllers;

use Engine\Services\Routers\WebRouter\WebRequestDTO;
use Modules\User\IUserConfigManagerWeb;
use Modules\User\Views\UserManagerView;
use Modules\User\Views\UserSetPasswordView;
use Modules\User\Views\UserSetRoleView;
use Modules\User\Views\UserSetUsernameView;

class UserController
{
    private IUserConfigManagerWeb $configManagerWeb;
    private UserManagerView $userManagerView;
    private UserSetUsernameView $setUsernameView;
    private UserSetPasswordView $setPasswordView;
    private UserSetRoleView $setRoleView;

    public function __construct(
        IUserConfigManagerWeb $configManagerWeb,
        UserManagerView $userManagerView,
        UserSetUsernameView $setUsernameView,
        UserSetPasswordView $setPasswordView,
        UserSetRoleView $setRoleView,
    ) {
        $this->configManagerWeb = $configManagerWeb;
        $this->userManagerView = $userManagerView;
        $this->setUsernameView = $setUsernameView;
        $this->setPasswordView = $setPasswordView;
        $this->setRoleView = $setRoleView;
    }

    public function userManager(WebRequestDTO $request): void
    {
        $this->userManagerView->render();
    }

    public function setUsername(WebRequestDTO $request): void
    {
        $this->setUsernameView->render();
    }

    public function setPassword(WebRequestDTO $request): void
    {
        $this->setPasswordView->render();
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
