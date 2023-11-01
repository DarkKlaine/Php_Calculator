<?php

namespace App\Controllers;

use App\Views\LoginView;
use App\Views\AccessDeniedView;

class AuthController extends BaseController
{
    public function accessDenied(): void
    {
        $view = new AccessDeniedView();
        $view->render();
    }

    public function login(): void
    {
        $view = new LoginView();
        $view->render();
    }
}
