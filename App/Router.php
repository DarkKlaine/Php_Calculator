<?php

namespace App;

use App\Controllers\CalculatorController;
use App\Controllers\HistoryController;
use App\Models\Logger\CalculatorLogger;

class Router
{

    private array $routes = [
        '/' => CalculatorController::class,
        '/history' => HistoryController::class,
    ];

    public function handleRequest($url): void
    {
        if (in_array($url, $this->bannedRoutes)) {
            return;
        }

        if (empty($this->routes[$url]) === false) {
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