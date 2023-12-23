<?php

namespace Modules\User\Controllers;

use Engine\Services\RedirectHandler\IWebRedirectHandler;
use Engine\Services\Routers\WebRouter\WebRequestDTO;
use Exception;
use JetBrains\PhpStorm\NoReturn;
use Modules\User\IUserConfigManagerWeb;
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
    private IUserStorage $userStorage;
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
        IUserStorage $userStorage,
        IUserConfigManagerWeb $configManager,
        IWebRedirectHandler $redirectHandler,
    ) {
        $this->userManagerView = $userManagerView;
        $this->setUsernameView = $setUsernameView;
        $this->setPasswordView = $setPasswordView;
        $this->setRoleView = $setRoleView;
        $this->userListView = $userListView;
        $this->userInfoView = $userInfoView;
        $this->userStorage = $userStorage;
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
        $allowedOperations = [
            UserConst::CREATE,
            UserConst::EDIT,
        ];

        if (in_array($operation, $allowedOperations)) {
            return $operation;
        }

        $url = $this->configManager->getUserManagerUrl();
        $this->redirectHandler->redirect($url);
    }

    public function setPassword(WebRequestDTO $request): void
    {
        $operation = $this->getVerifiedOperation($request);
        $username = $request->getPost(UserConst::USERNAME);
        $usernameOld = $request->getPost(UserConst::USERNAME_OLD);
        $isUsernameExist = $this->userStorage->isUserExist($username);

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
        $usersData = $this->userStorage->getAllUsers();
        $this->userListView->render($usersData);
    }

    /**
     * @throws Exception
     */
    public function showUserInfo(WebRequestDTO $request): void
    {
        $username = $request->getGet(UserConst::USERNAME);
        if ($username) {
            $userData = $this->userStorage->getUserByName($username);

            if ($userData) {
                $this->userInfoView->render($userData);

                return;
            }
        }
        throw new Exception(code: '404');
//        $url = $this->configManager->getShowUserListUrl();
//        $this->redirectHandler->redirect($url);
    }

    #[NoReturn] public function recordUserData(WebRequestDTO $request): void
    {
        $operation = $this->getVerifiedOperation($request);

        $oldUsername = $request->getPost(UserConst::USERNAME_OLD) ?? '';
        $username = $request->getPost(UserConst::USERNAME) ?? '';
        $passwordHash = $request->getPost(UserConst::PASSWORD) ?? '';
        $role = $request->getPost(UserConst::ROLE) ?? '';

        if ($operation === UserConst::CREATE) {
            if ($username !== '' && $passwordHash !== '' && $role !== '') {
                $this->userStorage->addUser($username, $passwordHash, $role);
            } else {
                $url = $this->configManager->getUserManagerUrl();
                $this->redirectHandler->redirect($url);
            }
        }

        if ($operation === UserConst::EDIT) {
            if ($oldUsername !== '' && $role !== '') {
                $this->userStorage->updateUser($oldUsername, $username, $passwordHash, $role);
            } else {
                $url = $this->configManager->getUserManagerUrl();
                $this->redirectHandler->redirect($url);
            }
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
        $operation = $request->getPost(UserConst::OPERATION);
        $username = $request->getPost(UserConst::USERNAME);

        if ($username !== '' && $operation !== UserConst::DELETE) {
            $userData = $this->userStorage->getUserByName($username);
            if ($userData !== []) {
                $this->userDeleteView->render($userData);

                return;
            }
        }

        if ($username !== '' && $operation === UserConst::DELETE) {
            $this->userStorage->deleteUser($username);
        }

        $url = $this->configManager->getShowUserListUrl();
        $this->redirectHandler->redirect($url);
    }
}
