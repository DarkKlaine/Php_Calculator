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
        $model->newAuthentication();
        $model->verifyAuthentication();
        $view = new LoginView();
        $view->render();

    }
}



/**В контроллерах создаю новый контроллер AuthController.
 * Он содержит 2 метода uShelNotPass и login и обрабатывает соотвествующие запросы от роутера.
 * uShelNotPass - просто показывает View, страничку с надписью "тебе тут не рады" и ссылкой на /login.
 * login - вызывает модель, с логикой логина
 * Показывает (через View) форму ввода логина и пароля.
 * .*/
