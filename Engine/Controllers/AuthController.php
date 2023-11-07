<?php

namespace Engine\Controllers;

use Engine\DTO\Request;

use Engine\Router\IAuth;
use Engine\Router\IAuthController;

class AuthController extends BaseController implements IAuthController
{
    public function accessDenied(): void
    {
        $view = $this->container->get(IAccessDeniedView::class);
        $view->render();
    }

    public function login(Request $request): void
    {
        $this->container->get(IAuth::class)->login($request);
        $view = $this->container->get(ILoginView::class);
        $view->render();
    }
}
