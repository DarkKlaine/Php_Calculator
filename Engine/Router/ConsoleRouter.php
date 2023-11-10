<?php

namespace Engine\Router;

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

        $this->validateInput($consoleInput);
        $this->processInput($consoleInput);
    }

    /**
     * Проверка валидности ввода validateInput
     * arr[1] есть в роутах
     * количество аргументов соответствуют экшну'
     * processInput
     * достать экшн $consoleInput[1]
     * достать аргументы после экшна array_slice($consoleInput, 2);
     * передать в регвест
     * передать регвест в контроллер
     */

    private function validateInput(array $consoleInput): void
    {
        $action = $consoleInput[1] ?? '';
        $routes = $this->configManager->getRoutes();

        if (empty($routes[$action])) {
            echo "Error! wrong action in route";
            die;
        }

        $minArgCount = $this->configManager->getMinArgCount($action);

        if (count($consoleInput) < $minArgCount) {
            echo "Error! too few args";
            die;
        }
    }

    private function processInput(array $consoleInput): void
    {
        $command = $consoleInput[1];

        if ($command === 'calculate') {
            echo '$command === calculate';
        } else {
            echo '$command !== calculate';
        }
    }
}