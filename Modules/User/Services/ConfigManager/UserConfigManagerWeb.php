<?php

namespace Modules\User\Services\ConfigManager;

use Engine\Services\ConfigManagers\BaseConfigManagerWeb;
use Modules\User\IUserConfigManagerWeb;

class UserConfigManagerWeb extends BaseConfigManagerWeb implements IUserConfigManagerWeb
{

    public function __construct(array $appConfig)
    {
        parent::__construct($appConfig);
    }

    public function getUserManagerUrl(): string {
        return $this->routes['UserManager']['url'];
    }

    public function getSetUsernameUrl(): string {
        return $this->routes['SetUsername']['url'];
    }

    public function getSetPasswordUrl(): string {
        return $this->routes['SetPassword']['url'];
    }

    public function getSetRoleUrl(): string {
        return $this->routes['SetRole']['url'];
    }

    public function getShowUsersListUrl(): string {
        return $this->routes['ShowUsersList']['url'];
    }

    public function getShowUserInfoUrl(): string {
        return $this->routes['ShowUserInfo']['url'];
    }
}