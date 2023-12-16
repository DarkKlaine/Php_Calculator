<?php

namespace Engine\Controllers;

use Engine\Models\IAuthSessionHandler;
use Engine\Services\Routers\WebRouter\WebRequestDTO;
use Engine\Views\EngineHomePageView;

class EngineControllerWeb implements IEngineControllerWeb
{
    private EngineHomePageView $engineHomePageView;
    private IAuthSessionHandler $authSessionHandler;

    public function __construct(
        EngineHomePageView $engineHomePageView,
        IAuthSessionHandler $authSessionHandler,
    ) {
        $this->engineHomePageView = $engineHomePageView;
        $this->authSessionHandler = $authSessionHandler;
    }

    public function engineHomePage(WebRequestDTO $request): void
    {
        if ($request->getPost()['operation'] ?? '' === 'Logout') {
            $this->authSessionHandler->setAuthStatus(false);
            $this->authSessionHandler->setUsername('Гость');
            $this->authSessionHandler->sessionDestroy();
        }
        $this->engineHomePageView->render();
    }
}
