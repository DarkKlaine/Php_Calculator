<?php

namespace Engine\Controllers;

use Engine\Router\WebRouter\IWebConfigManager;
use Engine\Router\WebRouter\IWebRedirectHandler;
use Engine\Router\WebRouter\WebRequestDTO;
use Psr\Log\LoggerInterface;

abstract class WebBaseController
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
            $this->logger->error("Ошибка в WebBaseController. Неправильный 'action' в webRoutes.php.");
            $this->redirectHandler->redirect($this->configManager->getHomeUrl());
        }
    }
}
