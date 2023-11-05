<?php

namespace Engine\App;

use Engine\App\DTO\ConfigDTO;
use Engine\App\DTO\Request;
use Engine\App\Models\Auth;
use Engine\App\Models\Logger\EngineLogger;
use Psr\Log\LoggerInterface;

class Router
{
    private array $routes;
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger, array $routes)
    {
        $this->logger = $logger;
        $this->routes = $routes;
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
                $auth = new Auth($url);
                $auth->verifyAuth();
            }

            $controllerName = $this->routes[$url]['controller'];

            $controller = new $controllerName();
            $controller->run($request);
        } else {
            $message = 'Ошибка 404. Запрос: ' . $url;
            $this->logger->debug($message);
            echo $message;
        }
    }
}
