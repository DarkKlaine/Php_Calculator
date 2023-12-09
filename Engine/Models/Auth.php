<?php

namespace Engine\Models;

use App\IUserProvider;
use Engine\Services\ConfigManagers\IAuthConfigManagerWeb;
use Engine\Services\DBConnector\IDBConnection;
use Engine\Services\RedirectHandler\IWebRedirectHandler;
use Engine\Services\Routers\WebRouter\IAuth;
use Engine\Services\Routers\WebRouter\WebRequestDTO;
use PDO;
use PDOException;
use Psr\Log\LoggerInterface;

class Auth implements IAuth
{
    private array $pageAccessLevels;
    private array $userAccessLevels;
    private IAuthSessionHandler $authSessionHandler;
    private IWebRedirectHandler $redirectHandler;
    private IAuthConfigManagerWeb $configManager;
    private IUserProvider $userProvider;

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
        $user = $this->userProvider->getUser($username);
        $role = $user['role'] ?? '';
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
        $username = $request->getPost()['username'] ?? null;
        $password = $request->getPost()['password'] ?? null;

        if ($username && $password) {
            $role = $this->verifyLoginData($username, $password);
            if ($role) {
                $this->authSessionHandler->setIsAuthorized(true);
                $this->authSessionHandler->setUsername($username);
                $this->authSessionHandler->setRole($role);
                $this->setDestroyTime();
                $this->redirectHandler->redirect($this->configManager->getHomeUrl());
            }
            $this->redirectHandler->redirect($this->configManager->getAccessDeniedPage());
        }
    }

    private function verifyLoginData(string $username, string $password): ?string
    {
        // Соединение с БД
        $user = $this->userProvider->getUser($username);
        // Верификация пароля
        $passwordHash = $user['password_hash'];
        // Если верификация пройдена получаем Роль
        if (password_verify($password, $passwordHash)) {
            return $user['role'] ?? null;
        }

        return null;
    }
}

