<?php

namespace Engine\App\Controllers;

use Engine\App\DTO\ConfigDTO;
use Engine\App\DTO\Request;
use Engine\App\Models\Logger\EngineLogger;

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
