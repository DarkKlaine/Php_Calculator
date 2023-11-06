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
        $view = $this->container->get(AccessDeniedView::class);
        $view->render();
    }

    public function login(Request $request): void
    {
        $this->container->get(Auth::class)->login($request);
        $view = $this->container->get(LoginView::class);
        $view->render();
    }
}
