<?php

namespace Engine\Controllers;

use Engine\Container\Container;
use Engine\Container\IContainer;
use Engine\DTO\ConfigManager;
use Engine\DTO\Request;
use Engine\Interfaces\RedirectHandler;
use Engine\Models\Logger\EngineLogger;
use Psr\Log\LoggerInterface;

class BaseController
{
    protected IContainer $container;
    protected RedirectHandler $redirectHandler;
    protected EngineLogger $logger;
    protected ConfigManager $configManager;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->logger = $container->get(EngineLogger::class);
        $this->redirectHandler = $container->get(RedirectHandler::class);
        $this->configManager = $container->get(ConfigManager::class);
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
