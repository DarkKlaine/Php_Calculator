<?php

namespace App;

use App\Controllers\CalculatorController;
use App\Controllers\HistoryController;
use App\DTO\ServerGlobalDTO;
use App\Models\Logger\CalculatorLogger;

class Router
{

    private array $routes = [
        '/' => CalculatorController::class,
        '/history' => HistoryController::class,
    ];

    public function handleRequest(): void
    {
        $url = $_SERVER['REQUEST_URI'];

        $serverGlobalDTO = new ServerGlobalDTO($_POST);

        if (empty($this->routes[$url]) === false) {
            $controllerName = $this->routes[$url];
            $controller = new $controllerName();
            $controller->run($serverGlobalDTO);
        } else {
            $logger = new CalculatorLogger();
            $logger->debug('Ошибка 404. Запрос:' . $url);
            echo "404";
        }

    }
}