<?php

namespace App\Controllers;

use App\DTO\Request;
use App\Models\Logger\CalculatorLogger;

abstract class BaseController
{
    public function run(Request $request, string $action): void
    {

        if (method_exists($this, $action)) {
            $this->$action($request);
        } else {
            $logger = new CalculatorLogger();
            $logger->error("Ошибка в BaseController. Неправильный 'action' в routes.php.");
            header("Location: /");
            exit;
        }
    }
}