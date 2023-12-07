<?php

namespace Modules\User\Controllers;

use Engine\Services\RedirectHandler\IWebRedirectHandler;
use Engine\Services\Routers\WebRouter\WebRequestDTO;
use JetBrains\PhpStorm\NoReturn;
use Modules\User\IUserConfigManagerWeb;
use Modules\User\Models\UserModel;
use Modules\User\Views\UserDeleteView;
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
    private UserDeleteView $userDeleteView;

    public function __construct(
        UserManagerView $userManagerView,
        UserSetUsernameView $setUsernameView,
        UserSetPasswordView $setPasswordView,
        UserSetRoleView $setRoleView,
        UserListView $userListView,
        UserInfoView $userInfoView,
        UserDeleteView $userDeleteView,
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
        $this->userDeleteView = $userDeleteView;
    }

    public function userManager(): void
    {
        $this->userManagerView->render();
    }

    public function setUsername(WebRequestDTO $request): void
    {
        $operation = $this->getVerifiedOperation($request);

        $usernameOld = $request->getPost(UserConst::USERNAME_OLD) ?: null;

        $this->setUsernameView->render($usernameOld, $operation);
    }

    private function getVerifiedOperation(WebRequestDTO $request): string
    {
        $operation = $request->getPost(UserConst::OPERATION);
        if (
            $operation !== UserConst::CREATE &&
            $operation !== UserConst::EDIT &&
            $operation !== UserConst::DELETE
        ) {
            $url = $this->configManager->getUserManagerUrl();
            $this->redirectHandler->redirect($url);
        }

        return $operation;
    }

    public function setPassword(WebRequestDTO $request): void
    {
        $operation = $this->getVerifiedOperation($request);
        $username = $request->getPost(UserConst::USERNAME);
        $usernameOld = $request->getPost(UserConst::USERNAME_OLD);
        $isUsernameExist = $this->userModel->isUsernameExist($username);

        if ($isUsernameExist && $username !== $usernameOld) {
            $this->setUsernameView->render($usernameOld, $operation, true);

            return;
        }
        $this->setPasswordView->render($username, $usernameOld, $operation);
    }

    public function setRole(WebRequestDTO $request): void
    {
        $operation = $this->getVerifiedOperation($request);
        $username = $request->getPost(UserConst::USERNAME);
        $usernameOld = $request->getPost(UserConst::USERNAME_OLD);
        $password = $request->getPost(UserConst::PASSWORD);
        $passwordConfirm = $request->getPost(UserConst::PASSWORD_CONFIRM);

        if ($password === $passwordConfirm) {
            $passwordHash = $password !== '' ? password_hash($password, PASSWORD_DEFAULT) : '';
            $this->setRoleView->render($username, $usernameOld, $operation, $passwordHash);

            return;
        }

        $this->setPasswordView->render($username, $usernameOld, $operation, true);
    }

    public function showUsersList(): void
    {
        $usersData = $this->userModel->getAllUsersDataFromDB();
        $this->userListView->render($usersData);
    }

    public function showUserInfo(WebRequestDTO $request): void
    {
        $username = $request->getGet(UserConst::USERNAME);
        if ($username) {
            $userData = $this->userModel->getUserDataFromDB($username);
            $this->userInfoView->render($userData);

            return;
        }

        $url = $this->configManager->getShowUserListUrl();
        $this->redirectHandler->redirect($url);
    }

    #[NoReturn] public function recordUserData(WebRequestDTO $request): void
    {
        $operation = $this->getVerifiedOperation($request);

        if ($operation === UserConst::CREATE) {
            $this->userModel->addUserToDB($request);
        }

        if ($operation === UserConst::EDIT) {
            $this->userModel->updateUserInDB($request);
        }

        if (!$username = $request->getPost(UserConst::USERNAME)) {
            $username = $request->getPost(UserConst::USERNAME_OLD);
        }

        $queryParams = [
            UserConst::USERNAME => $username,
        ];
        $postData = http_build_query($queryParams);
        $url = $this->configManager->getShowUserInfoUrl() . '/?' . $postData;

        $this->redirectHandler->redirect($url);
    }

    public function deleteUser(WebRequestDTO $request): void
    {
        $operation = $this->getVerifiedOperation($request);
        $username = $request->getPost(UserConst::USERNAME);

        if ($username !== '' && $operation !== UserConst::DELETE) {
            $userData = $this->userModel->getUserDataFromDB($username);
            if ($userData !== []) {
                $this->userDeleteView->render($userData);

                return;
            }
        }

        if ($username !== '' && $operation === UserConst::DELETE) {
            $this->userModel->deleteUserFromDB($username);
        }

        $url = $this->configManager->getShowUserListUrl();
        $this->redirectHandler->redirect($url);
    }
}
