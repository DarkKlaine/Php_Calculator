<?php

namespace App;

use App\Models\Logger\CalculatorLogger;
class Router
{

    private array $routes = [
        '/history' => 'App\Controllers\HistoryController',
        '/' => 'App\Controllers\CalculatorController',
        ];

    public function handleRequest($url): void
    {
        if (array_key_exists($url, $this->routes)) {
            $controllerName = $this->routes[$url];
            $controller = new $controllerName();
            $controller->run();
        } else {
            $logger = new CalculatorLogger();
            $logger->debug('Ошибка 404. Запрос:' . $url);
            echo "404";
        }
    }
}