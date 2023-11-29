<?php

namespace Engine\Controllers;

use Engine\Services\Routers\WebRouter\IAuth;
use Engine\Services\Routers\WebRouter\IAuthController;
use Engine\Services\Routers\WebRouter\WebRequestDTO;

class AuthControllerWeb implements IAuthController
{
    private IAccessDeniedView $accessDeniedView;
    private IAuth $auth;
    private ILoginView $loginView;

    public function __construct(
        IAccessDeniedView $accessDeniedView,
        IAuth             $auth,
        ILoginView        $loginView,
    )
    {
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
