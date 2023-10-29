<?php

namespace App;

use App\DTO\Request;
use App\Models\Logger\CalculatorLogger;

class Router
{
    private array $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    public function handleRequest(): void
    {
        $url = strtok($_SERVER['REQUEST_URI'], '?');

        $request = new Request($_POST, $_GET);

        if (empty($this->routes[$url]) === false) {
            $controllerName = $this->routes[$url];
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