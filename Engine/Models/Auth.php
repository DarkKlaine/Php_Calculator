<?php

namespace Engine\Models;

use Engine\DTO\ConfigDTO;
use Engine\DTO\Request;
use Engine\Interfaces\AuthSessionHandler;
use Engine\Interfaces\RedirectHandler;

class Auth implements AuthInterface
{
    private array $users;
    private AuthSessionHandler $authSessionHandler;
    private RedirectHandler $redirectHandler;


    public function __construct($redirectHandler, $authSessionHandler, array $users)
    {
        $this->redirectHandler = $redirectHandler;
        $this->authSessionHandler = $authSessionHandler;
        $this->users = $users;
    }

    public function verifyAuth(string $requestUrl): void
    {
        if (in_array($requestUrl, ConfigDTO::$authWhitelist)) {
            return;
        }

        if ($this->authSessionHandler->getIsAuthorized() !== true) {
            $this->redirectHandler->redirect(ConfigDTO::$accessDeniedPage);
        }

        if (time() > $this->authSessionHandler->getDestroyTime()) {
            session_destroy();
            $this->redirectHandler->redirect(ConfigDTO::$accessDeniedPage);
        }
    }

    public function login(Request $request): void
    {
        $loginInfo = $request->getPost() ? [$request->getPost()['username'] => $request->getPost()['password']] : [];

        if (!empty(array_intersect_assoc($this->users, $loginInfo))) {
            $this->authSessionHandler->setIsAuthorized(true);
            $this->authSessionHandler->setDestroyTime(time() + ConfigDTO::$authSessionLifeTime);
            $this->redirectHandler->redirect(ConfigDTO::$homeUrl);
        }
    }
}
