<?php

namespace Engine\Models;

use App\IUserProvider;
use Engine\Services\ConfigManagers\IAuthConfigManagerWeb;
use Engine\Services\RedirectHandler\IWebRedirectHandler;
use Engine\Services\Routers\WebRouter\IAuth;
use Engine\Services\Routers\WebRouter\WebRequestDTO;
use Modules\User\Controllers\UserConst;

class Auth implements IAuth
{
    private array $pageAccessLevels;
    private array $userAccessLevels;
    private IAuthSessionHandler $authSessionHandler;
    private IWebRedirectHandler $redirectHandler;
    private IAuthConfigManagerWeb $configManager;
    private IUserProvider $userProvider;
    private const GUEST = 'guest';

    public function __construct(
        array $pageAccessLevels,
        array $userAccessLevels,
        IWebRedirectHandler $redirectHandler,
        IAuthSessionHandler $authSessionHandler,
        IAuthConfigManagerWeb $configManager,
        IUserProvider $userProvider,
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

        $username = $this->authSessionHandler->getUsername();
        $role = '';
        if ($username === '') {
            $this->authSessionHandler->setUsername(self::GUEST);
        }

        if ($username !== self::GUEST) {
            $user = $this->userProvider->getUser($username);
            $role = $user[UserConst::ROLE] ?? '';
        }

        $accessNotGranted = !$this->checkAccess($role, $requestUrl);
        $isAuthorised = $this->authSessionHandler->getIsAuthorized();
        $isSessionExpired = time() > $this->authSessionHandler->getDestroyTime();

        if ($accessNotGranted) {
            $this->redirectHandler->redirect($accessDeniedPage);
        }

        if ($isAuthorised && $isSessionExpired) {
            session_destroy();
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
            if ($this->verifyLoginData($username, $password)) {
                $this->authSessionHandler->setIsAuthorized(true);
                $this->authSessionHandler->setUsername($username);
                $this->setDestroyTime();
                $this->redirectHandler->redirect($this->configManager->getHomeUrl());
            }
            $this->redirectHandler->redirect($this->configManager->getAccessDeniedPage());
        }
    }

    private function verifyLoginData(string $username, string $password): bool
    {
        if ($user = $this->userProvider->getUser($username)) {
            return password_verify($password, $user['password_hash']);
        }

        return false;
    }
}

