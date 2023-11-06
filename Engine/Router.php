<?php

namespace Engine;

use Engine\Container\Container;
use Engine\DTO\ConfigManager;
use Engine\DTO\Request;
use Engine\Models\Auth;
use Engine\Models\AuthInterface;
use Engine\Models\Logger\EngineLogger;
use Psr\Log\LoggerInterface;

class Router
{
    private array $routes;
    private AuthInterface $auth;
    private LoggerInterface $logger;
    private Container $container;
    private ConfigManager $configManager;

    public function __construct(Container $container)
    {
        $this->logger = $container->get(EngineLogger::class);
        $this->configManager = $container->get(ConfigManager::class);
        $this->routes = $this->configManager->getRoutes();
        $this->auth = $container->get(Auth::class);
        $this->container = $container;
    }

    public function handleRequest(): void
    {
        $url = strtok($_SERVER['REQUEST_URI'], '?');
        $route = $this->routes[$url];

        if (empty($route) === false) {
            $request = new Request(
                $_POST,
                $_GET,
                $route['action'] ?? '',
                $url,
            );

            if ($this->configManager->isAuthEnabled()) {
                $this->auth->verifyAuth($url);
            }

            $controllerName = $route['controller'];
            $controller = $this->container->get($controllerName);
            $controller->run($request);
        } else {
            $message = 'Ошибка 404. Запрос: ' . $url;
            $this->logger->debug($message);
            echo $message;
        }
    }
}
