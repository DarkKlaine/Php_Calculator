<?php

namespace Modules\User\Controllers;

use Engine\Services\RedirectHandler\IWebRedirectHandler;
use Engine\Services\Routers\WebRouter\WebRequestDTO;
use JetBrains\PhpStorm\NoReturn;
use Modules\User\IUserConfigManagerWeb;
use Modules\User\Models\UserModel;
use Modules\User\Views\UserInfoView;
use Modules\User\Views\UserListView;
use Modules\User\Views\UserManagerView;
use Modules\User\Views\UserSetPasswordView;
use Modules\User\Views\UserSetRoleView;
use Modules\User\Views\UserSetUsernameView;

class UserController
{
    private UserManagerView $userManagerView;
    private UserSetUsernameView $setUsernameView;
    private UserSetPasswordView $setPasswordView;
    private UserSetRoleView $setRoleView;
    private UserListView $userListView;
    private UserInfoView $userInfoView;
    private UserModel $userModel;
    private IWebRedirectHandler $redirectHandler;
    private IUserConfigManagerWeb $configManager;

    public function __construct(
        UserManagerView $userManagerView,
        UserSetUsernameView $setUsernameView,
        UserSetPasswordView $setPasswordView,
        UserSetRoleView $setRoleView,
        UserListView $userListView,
        UserInfoView $userInfoView,
        UserModel $userModel,
        IUserConfigManagerWeb $configManager,
        IWebRedirectHandler $redirectHandler,
    ) {
        $this->userManagerView = $userManagerView;
        $this->setUsernameView = $setUsernameView;
        $this->setPasswordView = $setPasswordView;
        $this->setRoleView = $setRoleView;
        $this->userListView = $userListView;
        $this->userInfoView = $userInfoView;
        $this->userModel = $userModel;
        $this->redirectHandler = $redirectHandler;
        $this->configManager = $configManager;
    }

    public function userManager(): void
    {
        $this->userManagerView->render();
    }

    public function setUsername(WebRequestDTO $request): void
    {
        $operation = $this->getVerifiedOperation($request);

        $this->setUsernameView->render($request, $operation);
    }

    private function getVerifiedOperation(WebRequestDTO $request): string
    {
        $operation = $request->getPost()['operation'] ?? '';
        if ($operation !== 'Create' && $operation !== 'Edit') {
            $url = $this->configManager->getUserManagerUrl();
            $this->redirectHandler->redirect($url);
        }

        return $operation;
    }

    public function setPassword(WebRequestDTO $request): void
    {
        $operation = $this->getVerifiedOperation($request);
        $username = $request->getPost()['username'] ?? '';
        $usernameExist = $this->userModel->isUsernameExist($username);
        if ($usernameExist) {
            $this->setUsernameView->render($request, $operation, true);

            return;
        }
        $this->setPasswordView->render($request);
    }

    public function setRole(WebRequestDTO $request): void
    {
        $operation = $this->getVerifiedOperation($request);

        $password = $request->getPost()['password'] ?? '';
        $passwordConfirm = $request->getPost()['passwordConfirm'] ?? '';
        if ($password === $passwordConfirm) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $this->setRoleView->render($request, $passwordHash);

            return;
        }
        $this->setPasswordView->render($request);
    }

    public function showUsersList(): void
    {
        $usersData = $this->userModel->getAllUsersDataFromDB();
        $this->userListView->render($usersData);
    }

    public function showUserInfo(WebRequestDTO $request): void
    {
        $username = $request->getGet()['username'] ?? '';
        if ($username !== '') {
            $userData = $this->userModel->getUserDataFromDB($username);
            if ($userData !== []) {
                $this->userInfoView->render($userData);

                return;
            }
        }

        $url = $this->configManager->getShowUserListUrl();
        $this->redirectHandler->redirect($url);
    }

    #[NoReturn] public function recordUserData(WebRequestDTO $request): void
    {
        $this->userModel->addUserToDB($request);

        $queryParams = [
            'username' => $request->getPost()['username'] ?? '',
        ];
        $postData = http_build_query($queryParams);
        $url = $this->configManager->getShowUserInfoUrl() . '/?' . $postData;
        $this->redirectHandler->redirect($url);
    }
}
