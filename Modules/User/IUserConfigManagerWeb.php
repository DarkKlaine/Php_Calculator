<?php

namespace Modules\User;

interface IUserConfigManagerWeb
{
    public function getUserManagerUrl(): string;

    public function getSetUsernameUrl(): string;

    public function getSetPasswordUrl(): string;

    public function getSetRoleUrl(): string;

    public function getShowUserListUrl(): string;

    public function getShowUserInfoUrl(): string;

    public function getRecordUserDataUrl(): string;

    public function getDeleteUserUrl(): string;
}
