<?php

namespace Engine\App\Models;

use Engine\App\DTO\ConfigDTO;
use Engine\App\DTO\Request;
use Engine\App\Interfaces\AuthSessionHandler;
use Engine\App\Interfaces\RedirectHandler;

class Auth
{
    private array $users;
    private string $requestUrl;
    private AuthSessionHandler $authSessionHandler;
    private RedirectHandler $redirectHandler;


    public function __construct($requestUrl)
    {
        $this->redirectHandler = new RedirectHandler();
        $this->authSessionHandler = new AuthSessionHandler();
        $this->users = require('../Config/users.php');
        $this->requestUrl = $requestUrl;
    }

    public function verifyAuth(): void
    {
        if (in_array($this->requestUrl, ConfigDTO::$authWhitelist)) {
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
