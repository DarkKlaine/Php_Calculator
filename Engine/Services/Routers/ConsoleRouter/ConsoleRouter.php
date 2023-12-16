<?php

namespace Engine\Services\Routers\ConsoleRouter;

use Engine\Controllers\ConsoleBaseController;
use Engine\Services\Container\Container;
use Engine\Services\Routers\AbstractRouter;
use Psr\Log\LoggerInterface;

class ConsoleRouter extends AbstractRouter
{
    private IConsoleConfigManager $configManager;

    public function __construct(
        LoggerInterface $logger,
        IConsoleConfigManager $configManager,
        Container $container,
    ) {
        parent::__construct($logger, $container);
        $this->configManager = $configManager;
    }

    public function handleRequest(): void
    {
        global $argv;
        $consoleInput = $argv;

        $command = $consoleInput[1] ?? '';
        $routes = $this->configManager->getRoutes();
        $route = $routes[$command] ?? [];

        $this->validateRoute($route);

        $request = new ConsoleRequestDTO(
            $route['action'] ?? '',
            array_slice($consoleInput, 2),
        );

        $controllerName = $route['controller'];
        /** @var ConsoleBaseController $controller */
        $controller = $this->container->get($controllerName);
        $controller->run($request);
    }

    private function validateRoute(array $route): void
    {
        if (empty($route)) {
            $this->logger->error("Ошибка! Неправильный action");
            echo "Ошибка! Неправильный action";
            exit;
        }
    }

    public function run(): void
    {
        // TODO: Implement run() method.
    }
}
