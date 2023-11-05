<?php

namespace Engine\Controllers;

use Engine\DTO\Request;
use Engine\Models\Auth;
use Engine\Views\AccessDeniedView;
use Engine\Views\LoginView;

class AuthController extends BaseController
{
    public function accessDenied(): void
    {
        $view = new AccessDeniedView();
        $view->render();
    }

    public function login(Request $request): void
    {
        $this->container->get('Auth')->login($request);
        $view = new LoginView();
        $view->render();
    }
}
