<?php

namespace Engine\Router;

use Engine\Container\Container;
use Engine\DTO\Request;
use Engine\IRouter;
use Psr\Log\LoggerInterface;

class Router implements IRouter
{
    private IAuth $auth;
    private LoggerInterface $logger;
    private Container $container;
    private IConfigManager $configManager;

    public function __construct(
        LoggerInterface $logger,
        IConfigManager  $configManager,
        IAuth           $auth,
        Container       $container)
    {
        $this->logger = $logger;
        $this->configManager = $configManager;
        $this->auth = $auth;
        $this->container = $container;
    }

    public function handleRequest(): void
    {
        $url = strtok($_SERVER['REQUEST_URI'], '?');
        $routes = $this->configManager->getRoutes();
        $route = $routes[$url];

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
