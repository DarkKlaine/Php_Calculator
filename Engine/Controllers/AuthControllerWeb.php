<?php

namespace Engine\Controllers;

use Engine\Services\Routers\WebRouter\IAuth;
use Engine\Services\Routers\WebRouter\IAuthController;
use Engine\Services\Routers\WebRouter\WebRequestDTO;
use Engine\Views\Page403View;

class AuthControllerWeb implements IAuthController
{
    private Page403View $accessDeniedView;
    private IAuth $auth;
    private ILoginView $loginView;

    public function __construct(
        Page403View $accessDeniedView,
        IAuth $auth,
        ILoginView $loginView,
    ) {
        $this->accessDeniedView = $accessDeniedView;
        $this->auth = $auth;
        $this->loginView = $loginView;
    }

    public function accessDenied(): void
    {
        $this->accessDeniedView->render();
    }

    public function login(WebRequestDTO $request): void
    {
        $this->auth->login($request);
        $this->loginView->render();
    }
}
