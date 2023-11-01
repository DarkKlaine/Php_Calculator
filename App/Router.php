<?php

namespace App;

use App\DTO\ConfigDTO;
use App\DTO\Request;
use App\Models\Logger\CalculatorLogger;

class Router
{
    private array $routes;

    public function __construct()
    {
        $this->routes = ConfigDTO::$routes;
    }

    public function handleRequest(): void
    {
        $url = strtok($_SERVER['REQUEST_URI'], '?');

        if (empty($this->routes[$url]) === false) {
            $request = new Request(
                $_POST,
                $_GET,
                $this->routes[$url]['action'] ?? '',
            );

            $controllerName = $this->routes[$url]['controller'];

            $controller = new $controllerName();
            $controller->run($request);
        } else {
            $message = 'Ошибка 404. Запрос: ' . $url;
            $logger = new CalculatorLogger();
            $logger->debug($message);
            echo $message;
        }
    }
}
