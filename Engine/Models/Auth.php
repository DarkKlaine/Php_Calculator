<?php

namespace Engine\Models;

use Engine\Services\ConfigManagers\IAuthConfigManagerWeb;
use Engine\Services\RedirectHandler\IWebRedirectHandler;
use Engine\Services\Routers\WebRouter\IAuth;
use Engine\Services\Routers\WebRouter\WebRequestDTO;
use Modules\User\Controllers\IUserStorage;
use Modules\User\Controllers\UserConst;

class Auth implements IAuth
{
    private array $pageAccessLevels;
    private array $userAccessLevels;
    private IAuthSessionHandler $authSessionHandler;
    private IWebRedirectHandler $redirectHandler;
    private IAuthConfigManagerWeb $configManager;
    private IUserStorage $userProvider;

    public function __construct(
        array $pageAccessLevels,
        array $userAccessLevels,
        IWebRedirectHandler $redirectHandler,
        IAuthSessionHandler $authSessionHandler,
        IAuthConfigManagerWeb $configManager,
        IUserStorage $userProvider,
    ) {
        $this->redirectHandler = $redirectHandler;
        $this->authSessionHandler = $authSessionHandler;
        $this->configManager = $configManager;
        $this->pageAccessLevels = $pageAccessLevels;
        $this->userAccessLevels = $userAccessLevels;
        $this->userProvider = $userProvider;
    }

    public function verifyAuth(string $requestUrl): void
    {
        $accessDeniedPage = $this->configManager->getAccessDeniedPage();
        if ($requestUrl === $accessDeniedPage) {
            return;
        }

        $userId = $this->authSessionHandler->getUserID();
        $role = '';

        if ($userId) {
            $user = $this->userProvider->getUserByID($userId);
            $this->authSessionHandler->setUsername($user[UserConst::USERNAME]);
            $role = $user[UserConst::ROLE] ?? '';
        }

        $accessNotGranted = !$this->checkAccess($role, $requestUrl);
        $isAuthorised = $this->authSessionHandler->getAuthStatus();
        $isSessionExpired = time() > $this->authSessionHandler->getDestroyTime();

        if ($accessNotGranted) {
            $this->redirectHandler->redirect($accessDeniedPage);
        }

        if ($isAuthorised && $isSessionExpired) {
            $this->authSessionHandler->sessionDestroy();
            $this->redirectHandler->redirect($accessDeniedPage);
        }

        $this->setDestroyTime();
    }

    public function checkAccess(string $userRole, string $requestUrl): bool
    {
        foreach ($this->pageAccessLevels as $pageUrl => $accessLevel) {
            if (fnmatch($pageUrl, $requestUrl)) {
                $userAccessLevel = $this->userAccessLevels[$userRole] ?? 0;

                return $userAccessLevel >= $accessLevel;
            }
        }

        return false;
    }

    private function setDestroyTime(): void
    {
        $this->authSessionHandler->setDestroyTime(time() + $this->configManager->getAuthSessionLifeTime());
    }

    public function login(WebRequestDTO $request): void
    {
        $username = $request->getPost(UserConst::USERNAME);
        $password = $request->getPost(UserConst::PASSWORD);

        if ($username && $password) {
            if ($user = $this->verifyLoginData($username, $password)) {
                $this->authSessionHandler->setAuthStatus(true);
                $this->authSessionHandler->setUserID($user[UserConst::USER_ID]);
                $this->authSessionHandler->setUsername($username);
                $this->setDestroyTime();
                $this->redirectHandler->redirect($this->configManager->getHomeUrl());
            }
            $this->redirectHandler->redirect($this->configManager->getAccessDeniedPage());
        }
    }

    private function verifyLoginData(string $username, string $password): ?array
    {

        if ($user = $this->userProvider->getUserByName($username)) {
            return password_verify($password, $user[UserConst::PASSWORD_HASH]) ? $user : null;
        }

        return null;
    }
}

