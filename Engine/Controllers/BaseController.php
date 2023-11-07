<?php

namespace Engine\Controllers;

use Engine\Container\Container;
use Engine\DTO\IConfigManager;
use Engine\DTO\Request;
use Engine\IContainer;
use Engine\Router\IRedirectHandler;
use Psr\Log\LoggerInterface;

class BaseController
{
    protected IContainer $container;
    protected IRedirectHandler $redirectHandler;
    protected LoggerInterface $logger;
    protected IConfigManager $configManager;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->logger = $container->get(LoggerInterface::class);
        $this->redirectHandler = $container->get(IRedirectHandler::class);
        $this->configManager = $container->get(IConfigManager::class);
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
