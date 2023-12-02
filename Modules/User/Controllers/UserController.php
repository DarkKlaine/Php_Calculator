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

    public function setUsername(): void
    {
        $this->setUsernameView->render();
    }

    public function setPassword(WebRequestDTO $request): void
    {
        $this->setPasswordView->render($request);
    }

    public function setRole(WebRequestDTO $request): void
    {
        //TODO Вынести валидацию до if
        if ($request->getPost()['password'] === $request->getPost()['passwordConfirm']) {
            $password = $request->getPost()['password'] ?? '';
            $passwordHash = $this->userModel->validateAndHashPassword($password);
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
