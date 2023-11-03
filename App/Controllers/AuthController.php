<?php

namespace App\Controllers;

use App\Auth;
use App\DTO\Request;
use App\Views\LoginView;
use App\Views\AccessDeniedView;

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
