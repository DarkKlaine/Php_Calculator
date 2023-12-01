<?php

namespace Engine\Models;

use Engine\Services\ConfigManagers\IAuthConfigManagerWeb;
use Engine\Services\Routers\WebRouter\IAuth;
use Engine\Services\Routers\WebRouter\IWebRedirectHandler;
use Engine\Services\Routers\WebRouter\WebRequestDTO;

class Auth implements IAuth
{
    private array $users;
    private IAuthSessionHandler $authSessionHandler;
    private IWebRedirectHandler $redirectHandler;
    private IAuthConfigManagerWeb $configManager;


    public function __construct(
        array $users,
        IWebRedirectHandler $redirectHandler,
        IAuthSessionHandler $authSessionHandler,
        IAuthConfigManagerWeb $configManager,
    ) {
        $this->users = $users;
        $this->redirectHandler = $redirectHandler;
        $this->authSessionHandler = $authSessionHandler;
        $this->configManager = $configManager;
    }

    public function verifyAuth(string $requestUrl): void
    {
        if (in_array($requestUrl, $this->configManager->getAuthWhitelist())) {
            return;
        }

        if ($this->authSessionHandler->getIsAuthorized() !== true) {
            $this->redirectHandler->redirect($this->configManager->getAccessDeniedPage());
        }

        if (time() > $this->authSessionHandler->getDestroyTime()) {
            session_destroy();
            $this->redirectHandler->redirect($this->configManager->getAccessDeniedPage());
        }

        $this->setDestroyTime();
    }

    public function login(WebRequestDTO $request): void
    {
        $loginInfo = $request->getPost() ? [$request->getPost()['username'] => $request->getPost()['password']] : [];

        if (!empty(array_intersect_assoc($this->users, $loginInfo))) {
            $this->authSessionHandler->setIsAuthorized(true);
            $this->setDestroyTime();
            $this->redirectHandler->redirect($this->configManager->getHomeUrl());
        }
    }

    private function setDestroyTime(): void
    {
        $this->authSessionHandler->setDestroyTime(time() + $this->configManager->getAuthSessionLifeTime());
    }
}
