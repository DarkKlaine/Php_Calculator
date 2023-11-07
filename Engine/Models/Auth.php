<?php

namespace Engine\Models;

use Engine\DTO\Request;
use Engine\Router\IAuth;
use Engine\Router\IConfigManager;
use Engine\Router\IRedirectHandler;

class Auth implements IAuth
{
    private array $users;
    private IAuthSessionHandler $authSessionHandler;
    private IRedirectHandler $redirectHandler;
    private IConfigManager $configManager;


    public function __construct(
        array               $users,
        IRedirectHandler    $redirectHandler,
        IAuthSessionHandler $authSessionHandler,
        IConfigManager      $configManager,
    )
    {
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
    }

    public function login(Request $request): void
    {
        $loginInfo = $request->getPost() ? [$request->getPost()['username'] => $request->getPost()['password']] : [];

        if (!empty(array_intersect_assoc($this->users, $loginInfo))) {
            $this->authSessionHandler->setIsAuthorized(true);
            $this->authSessionHandler->setDestroyTime(time() + $this->configManager->getAuthSessionLifeTime());
            $this->redirectHandler->redirect($this->configManager->getHomeURL());
        }
    }
}
