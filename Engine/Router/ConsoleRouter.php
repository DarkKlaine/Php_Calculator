<?php

namespace Engine\Router;

use Engine\DTO\ConsoleRequestDTO;
use Engine\IConsoleRouter;
use Engine\Services\Container\Container;
use Psr\Log\LoggerInterface;

class ConsoleRouter implements IConsoleRouter
{
    private LoggerInterface $logger;
    private Container $container;
    private IConsoleConfigManager $configManager;

    public function __construct(
        LoggerInterface   $logger,
        IConsoleConfigManager $configManager,
        Container         $container,
    )
    {
        $this->logger = $logger;
        $this->configManager = $configManager;
        $this->container = $container;
    }

    public function handleRequest(): void
    {
        global $argv;
        $consoleInput = $argv;

        $action = $consoleInput[1] ?? '';
        $routes = $this->configManager->getRoutes();
        $route = $routes[$action];

        $this->validateRoute($route);
        $this->validateArgumentCount($consoleInput, $action);

        $request = new ConsoleRequestDTO(
            $action,
            array_slice($consoleInput, 2),
        );

        $controllerName = $route['controller'];
        $controller = $this->container->get($controllerName);
        $controller->run($request);

    }

    private function validateRoute(array $route): void
    {
        if (empty($route)) {
            echo "Ошибка! Неправильный action";
            die;
        }
    }

    private function validateArgumentCount(array $consoleInput, string $action): void
    {
        $minArgCount = $this->configManager->getMinArgCount($action);
        if (count($consoleInput) < $minArgCount) {
            echo "Ошибка! Недостаточно аргументов";
            die;
        }
    }
}