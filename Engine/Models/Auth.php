<?php

namespace Engine\Models;

use Engine\Container\Container;
use Engine\DTO\ConfigManager;
use Engine\DTO\Request;
use Engine\Interfaces\AuthSessionHandler;
use Engine\Interfaces\RedirectHandler;

class Auth implements AuthInterface
{
    private array $users;
    private AuthSessionHandler $authSessionHandler;
    private RedirectHandler $redirectHandler;
    private ConfigManager $configManager;


    public function __construct(array $users, Container $container)
    {
        $this->redirectHandler = $container->get(RedirectHandler::class);
        $this->authSessionHandler = $container->get(AuthSessionHandler::class);
        $this->configManager = $container->get(ConfigManager::class);
        $this->users = $users;
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
