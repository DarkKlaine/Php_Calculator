<?php

namespace Engine;

use Engine\Container\Container;
use Engine\DTO\ConfigDTO;
use Engine\DTO\Request;
use Engine\Models\Auth;
use Engine\Models\AuthInterface;
use Psr\Log\LoggerInterface;

class Router
{
    private array $routes;
    private AuthInterface $auth;
    private LoggerInterface $logger;
    private Container $container;

    public function __construct(LoggerInterface $logger, array $routes, AuthInterface $auth, Container $container)
    {
        $this->logger = $logger;
        $this->routes = $routes;
        $this->auth = $auth;
        $this->container = $container;
    }

    public function handleRequest(): void
    {
        $url = strtok($_SERVER['REQUEST_URI'], '?');

        if (empty($this->routes[$url]) === false) {
            $request = new Request(
                $_POST,
                $_GET,
                $this->routes[$url]['action'] ?? '',
                $url,
            );

            if (ConfigDTO::$authEnabled) {
                $this->auth->verifyAuth($url);
            }

            $controllerName = $this->routes[$url]['controller'];
            $controller = $this->container->get($controllerName);
            $controller->run($request);
        } else {
            $message = 'Ошибка 404. Запрос: ' . $url;
            $this->logger->debug($message);
            echo $message;
        }
    }
}
