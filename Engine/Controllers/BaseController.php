<?php

namespace Engine\Controllers;

use Engine\DTO\ConfigDTO;
use Engine\DTO\Request;
use Engine\Models\Logger\EngineLogger;

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
