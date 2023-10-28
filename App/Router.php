<?php

namespace App;

use App\Controllers\CalculatorController;
use App\Controllers\HistoryController;
use App\Controllers\UIController;
use App\DTO\ServerGlobalDTO;
use App\Models\Logger\CalculatorLogger;

class Router
{

    private array $routes = [
        '/' => UIController::class,
        '/history' => HistoryController::class,
        '/calculate' => CalculatorController::class,
    ];

    public function handleRequest(): void
    {
        $logger = new CalculatorLogger();

//      $url = $_SERVER['REQUEST_URI'];
//      if (str_contains($url, '?')) {
//          $url = strstr($url, '?', true);
//      }

        $url = strtok($_SERVER['REQUEST_URI'], '?');

        $serverGlobalDTO = new ServerGlobalDTO($_POST, $_GET);

        if (empty($this->routes[$url]) === false) {
            $logger->debug('Запрос:' . $url);
            $controllerName = $this->routes[$url];
            $controller = new $controllerName();
            $controller->run($serverGlobalDTO);
        } else {
            $logger->debug('Ошибка 404. Запрос:' . $url);
            echo "404";
        }

    }
}