<?php

namespace Engine\Controllers;

use Engine\DTO\WebRequestDTO;
use Engine\Router\IAuth;
use Engine\Router\IAuthController;
use Engine\Router\IWebConfigManager;
use Engine\Router\IWebRedirectHandler;
use Psr\Log\LoggerInterface;

class AuthController extends BaseController implements IAuthController
{
    private IAccessDeniedView $accessDeniedView;
    private IAuth $auth;
    private ILoginView $loginView;

    public function __construct(
        IWebRedirectHandler $redirectHandler,
        LoggerInterface     $logger,
        IWebConfigManager   $configManager,
        IAccessDeniedView   $accessDeniedView,
        IAuth               $auth,
        ILoginView          $loginView,
    )
    {
        parent::__construct($redirectHandler, $logger, $configManager);
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
