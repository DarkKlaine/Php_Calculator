<?php

namespace Engine\Controllers;

use Engine\Models\IAuthSessionHandler;
use Engine\Services\Routers\WebRouter\WebRequestDTO;
use Engine\Views\EngineHomePageView;
use Modules\User\Controllers\UserConst;

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
        if ($request->getPost(UserConst::OPERATION) === UserConst::LOGOUT) {
            $this->authSessionHandler->setAuthStatus(false);
            $this->authSessionHandler->setUsername(UserConst::GUEST_NAME);
            $this->authSessionHandler->sessionDestroy();
        }
        $this->engineHomePageView->render();
    }
}
