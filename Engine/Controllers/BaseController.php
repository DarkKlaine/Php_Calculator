<?php

namespace Engine\Controllers;

use Engine\DTO\WebRequestDTO;
use Engine\Router\IWebConfigManager;
use Engine\Router\IWebRedirectHandler;
use Psr\Log\LoggerInterface;

class BaseController
{
    protected IWebRedirectHandler $redirectHandler;
    protected LoggerInterface $logger;
    protected IWebConfigManager $configManager;

    public function __construct(
        IWebRedirectHandler $redirectHandler,
        LoggerInterface     $logger,
        IWebConfigManager   $configManager,
    )
    {
        $this->logger = $logger;
        $this->redirectHandler = $redirectHandler;
        $this->configManager = $configManager;
    }

    public function run(WebRequestDTO $request): void
    {
        $action = $request->getAction();

        if (method_exists($this, $action)) {
            $this->$action($request);
        } else {

            $this->logger->error("Ошибка в BaseController. Неправильный 'action' в webRoutes.php.");
            $this->redirectHandler->redirect($this->configManager->getHomeUrl());
        }
    }
}
