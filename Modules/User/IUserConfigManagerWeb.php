<?php

namespace Modules\User;

interface IUserConfigManagerWeb
{
    public function getUserManagerUrl(): string;
    public function getSetUsernameUrl(): string;
    public function getSetPasswordUrl(): string;
    public function getSetRoleUrl(): string;
    public function getShowUsersListUrl(): string;
    public function getShowUserInfoUrl(): string;
}