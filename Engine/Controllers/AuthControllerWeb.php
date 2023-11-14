<?php

namespace Engine\Controllers;

use Engine\Router\WebRouter\IAuth;
use Engine\Router\WebRouter\IAuthController;
use Engine\Router\WebRouter\IWebConfigManager;
use Engine\Router\WebRouter\IWebRedirectHandler;
use Engine\Router\WebRouter\WebRequestDTO;
use Psr\Log\LoggerInterface;

class AuthControllerWeb extends WebBaseController implements IAuthController
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
