<?php

namespace Engine\Controllers;

use Engine\Services\Routers\ConsoleRouter\ConsoleRequestDTO;
use Psr\Log\LoggerInterface;

abstract class ConsoleBaseController
{
    protected LoggerInterface $logger;

    public function __construct(
        LoggerInterface     $logger,
    )
    {
        $this->logger = $logger;
    }

    public function run(ConsoleRequestDTO $request): void
    {
        $action = $request->getAction();

        if (method_exists($this, $action)) {
            $this->$action($request);
        } else {
            $this->logger->error("Ошибка в ConsoleBaseController. Неправильный 'action' в consoleRoutes.php.");
            die;
        }
    }
}
