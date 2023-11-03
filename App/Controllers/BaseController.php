<?php

namespace App\Controllers;

use App\EngineLogger;
use App\DTO\ConfigDTO;
use App\DTO\Request;

abstract class BaseController
{
    public function run(Request $request): void
    {
        $action = $request->getAction();

        if (method_exists($this, $action)) {
            $this->$action($request);
        } else {
            $logger = new EngineLogger();
            $logger->error("Ошибка в BaseController. Неправильный 'action' в routes.php.");
            header("Location: " . ConfigDTO::$homeUrl);
            exit;
        }
    }
}
