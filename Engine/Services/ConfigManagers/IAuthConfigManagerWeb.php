<?php

namespace Engine\Services\ConfigManagers;

interface IAuthConfigManagerWeb
{
    public function get403PageUrl(): string;

    public function getAuthSessionLifeTime(): int;

    public function isAuthEnabled(): bool;

    public function getAuthWhitelist(): array;
}
