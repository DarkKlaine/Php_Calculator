<?php

namespace Engine\Controllers;

use Engine\Services\Routers\WebRouter\IAuth;
use Engine\Services\Routers\WebRouter\IAuthController;
use Engine\Services\Routers\WebRouter\IWebConfigManager;
use Engine\Services\Routers\WebRouter\IWebRedirectHandler;
use Engine\Services\Routers\WebRouter\WebRequestDTO;
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
