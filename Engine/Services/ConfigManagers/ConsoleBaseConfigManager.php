<?php

namespace Engine\Services\ConfigManagers;

use Engine\Services\Routers\ConsoleRouter\IConsoleConfigManager;

class ConsoleBaseConfigManager implements IConsoleConfigManager
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

    public function getMinArgCount(string $action): int
    {
        return $this->routes[$action]['minArgs'] + 2;
    }
}
