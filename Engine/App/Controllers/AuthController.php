<?php

namespace Engine\App\Controllers;

use Engine\App\DTO\Request;
use Engine\App\Models\Auth;
use Engine\App\Views\AccessDeniedView;
use Engine\App\Views\LoginView;

class AuthController extends BaseController
{
    public function accessDenied(): void
    {
        $view = new AccessDeniedView();
        $view->render();
    }

    public function login(Request $request): void
    {
        $login = new Auth($request->getRequestURL());
        $login->login($request);
        $view = new LoginView();
        $view->render();
    }
}
