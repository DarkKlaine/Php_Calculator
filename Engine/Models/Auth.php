<?php

namespace Engine\Models;

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
    private LoggerInterface $logger;
    private IDBConnection $connection;

    public function __construct(
        array $pageAccessLevels,
        array $userAccessLevels,
        IWebRedirectHandler $redirectHandler,
        IAuthSessionHandler $authSessionHandler,
        IAuthConfigManagerWeb $configManager,
        LoggerInterface $logger,
        IDBConnection $connection,
    ) {
        $this->redirectHandler = $redirectHandler;
        $this->authSessionHandler = $authSessionHandler;
        $this->configManager = $configManager;
        $this->pageAccessLevels = $pageAccessLevels;
        $this->userAccessLevels = $userAccessLevels;
        $this->logger = $logger;
        $this->connection = $connection;
    }

    public function verifyAuth(string $requestUrl): void
    {
        $role = $this->authSessionHandler->getRole();
        if ($this->checkAccessLevel($role, $requestUrl)) {
            return;
        } else {
            $this->redirectHandler->redirect($this->configManager->getAccessDeniedPage());
        }

        if (time() > $this->authSessionHandler->getDestroyTime()) {
            session_destroy();
            $this->redirectHandler->redirect($this->configManager->getAccessDeniedPage());
        }

        $this->setDestroyTime();
    }

    public function checkAccessLevel(string $userRole, string $requestUrl): bool
    {
        foreach ($this->pageAccessLevels as $pageUrl => $accessLevel) {
            if (fnmatch($pageUrl, $requestUrl)) {
                $userAccessLevel = $this->userAccessLevels[$userRole] ?? 0;

                if ($userAccessLevel >= $accessLevel) {
                    return true;
                } else {
                    return false;
                }
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
        $login = $request->getPost()['username'] ?? '';
        $password = $request->getPost()['password'] ?? '';
        if ($login !== '' && $password !== '') {
            $role = $this->verifyLoginAndPassword($login, $password);
            if ($role !== null) {
                $this->authSessionHandler->setIsAuthorized(true);
                $this->authSessionHandler->setRole($role);
                $this->setDestroyTime();
                $this->redirectHandler->redirect($this->configManager->getHomeUrl());
            }
            $this->redirectHandler->redirect($this->configManager->getAccessDeniedPage());
        }
    }

    private function verifyLoginAndPassword(string $login, string $password): ?string
    {
        $connection = $this->connection->getConnection();

        $sqlSelect = "SELECT `username`, `password_hash`, `role` FROM `users` WHERE `username` = '$login'";
        $role = null;

        try {
            $result = $connection->query($sqlSelect);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $passwordHash = $row['password_hash'];
            if (password_verify($password, $passwordHash)) {
                $role = $row['role'] ?? null;
            }
        } catch (PDOException $e) {
            echo "Ошибка при получении записи: " . $e->getMessage();
            $this->logger->error("Ошибка при получении записи: " . $e->getMessage());
        }

        $this->connection->closeConnection();

        return $role;
    }
}
