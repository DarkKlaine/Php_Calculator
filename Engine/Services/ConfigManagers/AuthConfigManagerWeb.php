<?php

namespace Engine\Services\ConfigManagers;

class AuthConfigManagerWeb extends BaseConfigManagerWeb implements IAuthConfigManagerWeb
{
    private string $accessDeniedPage;
    private array $authWhitelist;
    private bool $authEnabled;
    private int $authSessionLifeTime;

    public function __construct($appConfig)
    {
        parent::__construct($appConfig);
        $this->authEnabled = $appConfig['authEnabled'];
        $this->authSessionLifeTime = $appConfig['authSessionLifeTime'];
        $this->accessDeniedPage = $appConfig['authWhitelist']['accessDenied'];
        $this->authWhitelist = $appConfig['authWhitelist'];
    }

    public function getAccessDeniedPage(): string
    {
        return $this->accessDeniedPage;
    }

    public function getAuthSessionLifeTime(): int
    {
        return $this->authSessionLifeTime;
    }

    public function isAuthEnabled(): bool
    {
        return $this->authEnabled;
    }

    public function getAuthWhitelist(): array
    {
        return $this->authWhitelist;
    }

}