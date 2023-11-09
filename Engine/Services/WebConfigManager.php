<?php

namespace Engine\Services;

use Engine\Router\IWebConfigManager;

class WebConfigManager implements IWebConfigManager
{
    private string $homeUrl;
    private string $accessDeniedPage;
    private array $authWhitelist;
    private bool $authEnabled;
    private int $authSessionLifeTime;
    private array $routes;

    public function __construct($appConfig)
    {
        $this->homeUrl = $appConfig['homeUrl'];
        $this->authEnabled = $appConfig['authEnabled'];
        $this->authSessionLifeTime = $appConfig['authSessionLifeTime'];
        $this->accessDeniedPage = $appConfig['authWhitelist']['accessDenied'];
        $this->authWhitelist = $appConfig['authWhitelist'];
        $this->routes = $appConfig['routes'];
    }

    public function getAccessDeniedPage(): string
    {
        return $this->accessDeniedPage;
    }

    public function getRoutes(): array
    {
        return $this->routes;
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

    public function getHomeUrl(): string
    {
        return $this->homeUrl;
    }
}
