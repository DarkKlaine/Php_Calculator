<?php

namespace App\Controllers;

use App\Application;
use App\DTO\Request;
use App\Models\Logger\CalculatorLogger;

abstract class BaseController
{
    public function run(Request $request): void
    {
        $action = $request->getAction();

        if (method_exists($this, $action)) {
            $this->$action($request);
        } else {
            $logger = new CalculatorLogger();
            $logger->error("Ошибка в BaseController. Неправильный 'action' в routes.php.");
            header("Location: " . Application::$homeUrl);
            exit;
        }
    }
}
