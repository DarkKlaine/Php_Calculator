<?php

namespace App\Models;

use App\Application;

class AuthModel
{
    private array $users;

    public function __construct(){
        $this->users = require_once('../../Config/users.php');
    }

    public function authentificationVerify()
    {
        if (isset($_SESSION['loginInfo']) === false){
            return;
        }

        if (!empty(array_intersect_assoc($this->users, $_SESSION['loginInfo']))) {
            $_SESSION['authorized'] = true;
            header("Location: " . Application::$homeUrl);
            exit;
        }
    }

    public function newAuthentication (){
        $_SESSION['loginInfo'] = [$_POST['username'] => $_POST['password']];
    }
}

/**
 * verifyAuthentication - проверяет 'loginInfo' из $_SESSION, если есть, достает оттуда данные логина сравнивает,
 * если совпадают с пользователем из файла - создает запись в сессии 'autorized' => true и
 * переадресует на главную страницу.
 * Если данных в 'loginInfo' нету - возвращвет ничего
 * newAuthentication - Данные получаются из формы и записываются в сессию в 'loginInfo' в формате [username => pass].
 */