<?php

namespace Modules\User\Controllers;

use Engine\Services\DBConnector\IDBConnection;
use Engine\Services\Routers\WebRouter\WebRequestDTO;
use Modules\User\IUserConfigManagerWeb;
use Modules\User\Views\UserInfoView;
use Modules\User\Views\UserListView;
use Modules\User\Views\UserManagerView;
use Modules\User\Views\UserSetPasswordView;
use Modules\User\Views\UserSetRoleView;
use Modules\User\Views\UserSetUsernameView;
use PDOException;

class UserController
{
    private IUserConfigManagerWeb $configManagerWeb;
    private UserManagerView $userManagerView;
    private UserSetUsernameView $setUsernameView;
    private UserSetPasswordView $setPasswordView;
    private UserSetRoleView $setRoleView;
    private UserListView $userListView;
    private UserInfoView $userInfoView;
    private IDBConnection $connection;

    public function __construct(
        IUserConfigManagerWeb $configManagerWeb,
        UserManagerView $userManagerView,
        UserSetUsernameView $setUsernameView,
        UserSetPasswordView $setPasswordView,
        UserSetRoleView $setRoleView,
        UserListView $userListView,
        UserInfoView $userInfoView,
        IDBConnection $connection
    ) {
        $this->configManagerWeb = $configManagerWeb;
        $this->userManagerView = $userManagerView;
        $this->setUsernameView = $setUsernameView;
        $this->setPasswordView = $setPasswordView;
        $this->setRoleView = $setRoleView;
        $this->userListView = $userListView;
        $this->userInfoView = $userInfoView;
        $this->connection = $connection;
    }

    public function userManager(WebRequestDTO $request): void
    {
        $this->userManagerView->render();
    }

    public function setUsername(WebRequestDTO $request): void
    {
        $this->setUsernameView->render();
    }

    public function setPassword(WebRequestDTO $request): void
    {
        $this->setPasswordView->render($request);
    }

    public function setRole(WebRequestDTO $request): void
    {
        if ($request->getPost()['password'] === $request->getPost()['passwordConfirm']) {
            $this->setRoleView->render($request);
        }
        $this->setPasswordView->render($request);
    }

    public function showUsersList(WebRequestDTO $request): void
    {
        $this->userListView->render();
    }

    public function showUserInfo(WebRequestDTO $request): void
    {
        $this->addUserToDB($request);
        var_dump($_POST);
        exit;
        $this->userInfoView->render();
    }
    private function addUserToDB(WebRequestDTO $request): void
    {
        $connection = $this->connection->getConnection();
        $username = $request->getPost()['username'] ?? '';
        $password = $request->getPost()['password'] ?? '';
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);;
        $role = $request->getPost()['role'] ?? '';



        $sqlInsert = "INSERT INTO `users` (`username`, `password_hash`, `role`) VALUES ('$username', '$passwordHash', '$role')";

        try {
            $connection->exec($sqlInsert);
        } catch (PDOException $e) {
            echo "Ошибка при создании записи: " . $e->getMessage();
            //$this->logger->error("Ошибка при создании записи: " . $e->getMessage());
        }

        $this->connection->closeConnection();
    }
}
