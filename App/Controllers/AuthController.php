<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Views\LoginView;
use App\Views\UShellNotPassView;

class AuthController extends BaseController
{
    public function uShellNotPass(): void
    {
        $view = new UShellNotPassView();
        $view->render();
    }

    public function login(): void
    {
        $model = new AuthModel();
        $model->auth();
        $view = new LoginView();
        $view->render();
    }
}
