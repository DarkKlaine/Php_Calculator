<?php

namespace App;

use App\DTO\ConfigDTO;
use App\DTO\Request;
use App\Interfaces\RedirectHandler;
use App\Interfaces\SessionHandler;

class Auth
{
    private array $users;
    private string $requestUrl;
    private SessionHandler $sessionHandler;
    private RedirectHandler $redirectHandler;


    public function __construct($requestUrl)
    {
        $this->redirectHandler = new RedirectHandler();
        $this->sessionHandler = new SessionHandler();
        $this->users = require('../Config/users.php');
        $this->requestUrl = $requestUrl;
    }

    public function verifyAuth(): void
    {
        if (in_array($this->requestUrl, ConfigDTO::$authWhitelist)) {
            return;
        }

        if ($this->sessionHandler->getIsAuthorized() !== true) {
            $this->redirectHandler->redirect(ConfigDTO::$accessDeniedPage);
        }

        if (time() > $this->sessionHandler->getDestroyTime()) {
            session_destroy();
            $this->redirectHandler->redirect(ConfigDTO::$accessDeniedPage);
        }
    }

    public function login(Request $request): void
    {
        $loginInfo = $request->getPost() ? [$request->getPost()['username'] => $request->getPost()['password']] : [];

        if (!empty(array_intersect_assoc($this->users, $loginInfo))) {
            $this->sessionHandler->setIsAuthorized(true);
            $this->sessionHandler->setDestroyTime(time() + ConfigDTO::$authSessionLifeTime);
            $this->redirectHandler->redirect(ConfigDTO::$homeUrl);
        }

    }
}
