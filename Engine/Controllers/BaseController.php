<?php

namespace Engine\Controllers;

use Engine\DTO\Request;
use Engine\Router\IConfigManager;
use Engine\Router\IRedirectHandler;
use Psr\Log\LoggerInterface;

class BaseController
{
    protected IRedirectHandler $redirectHandler;
    protected LoggerInterface $logger;
    protected IConfigManager $configManager;

    public function __construct(
        IRedirectHandler $redirectHandler,
        LoggerInterface  $logger,
        IConfigManager   $configManager,
    )
    {
        $this->logger = $logger;
        $this->redirectHandler = $redirectHandler;
        $this->configManager = $configManager;
    }

    public function run(Request $request): void
    {
        $action = $request->getAction();

        if (method_exists($this, $action)) {
            $this->$action($request);
        } else {

            $this->logger->error("Ошибка в BaseController. Неправильный 'action' в routes.php.");
            $this->redirectHandler->redirect($this->configManager->getHomeURL());
        }
    }
}
