<?php

namespace Engine\Services\ConfigManagers;

use Engine\Services\Routers\WebRouter\IWebConfigManager;

class BaseConfigManagerWeb implements IWebConfigManager
{
    private string $homeUrl;
    protected array $routes;

    public function __construct($appConfig)
    {
        $this->homeUrl = $appConfig['homeUrl'];
        $this->routes = $appConfig['routes'];
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function getHomeUrl(): string
    {
        return $this->homeUrl;
    }
}
