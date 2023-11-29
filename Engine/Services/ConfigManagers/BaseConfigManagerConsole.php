<?php

namespace Engine\Services\ConfigManagers;

use Engine\Services\Routers\ConsoleRouter\IConsoleConfigManager;

class BaseConfigManagerConsole implements IConsoleConfigManager
{
    private array $routes;

    public function __construct($appConfig)
    {
        $this->routes = $appConfig['routes'];
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}
