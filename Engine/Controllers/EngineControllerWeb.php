<?php

namespace Engine\Controllers;

use Engine\Services\Routers\WebRouter\IWebConfigManager;
use Engine\Services\Routers\WebRouter\IWebRedirectHandler;
use Engine\Views\EngineHomePageView;
use Psr\Log\LoggerInterface;

class EngineControllerWeb extends WebBaseController implements IEngineControllerWeb
{
    private EngineHomePageView $engineHomePageView;

    public function __construct(
        IWebRedirectHandler $redirectHandler,
        LoggerInterface     $logger,
        IWebConfigManager   $configManager,
        EngineHomePageView   $engineHomePageView,
    )
    {
        parent::__construct($redirectHandler, $logger, $configManager);
        $this->engineHomePageView = $engineHomePageView;
    }

    public function engineHomePage(): void
    {
        $this->engineHomePageView->render();
    }
}
