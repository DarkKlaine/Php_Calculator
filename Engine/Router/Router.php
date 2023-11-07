<?php

namespace Engine\Router;

use Engine\Container\Container;
use Engine\DTO\IConfigManager;
use Engine\DTO\Request;
use Engine\IRouter;
use Psr\Log\LoggerInterface;

class Router implements IRouter
{
    private array $routes;
    private IAuth $auth;
    private LoggerInterface $logger;
    private Container $container;
    private IConfigManager $configManager;

    public function __construct(Container $container)
    {
        $this->logger = $container->get(LoggerInterface::class);
        $this->configManager = $container->get(IConfigManager::class);
        $this->routes = $this->configManager->getRoutes();
        $this->auth = $container->get(IAuth::class);
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
