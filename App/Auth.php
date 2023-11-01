<?php

namespace App;

use App\DTO\ConfigDTO;

class Auth
{
    private array $users;
    private string $requestUrl;

    public function __construct()
    {
        $this->users = require_once('../Config/users.php');
        $this->requestUrl = strtok($_SERVER['REQUEST_URI'], '?');
    }

    public function verifyAuth(): void
    {
        //Если запрос ведет на логин, обрабатываем
        if ($this->requestUrl === ConfigDTO::$loginPage) {
            if ($_POST) {
                $_SESSION['loginInfo'] = [$_POST['username'] => $_POST['password']];
            }
            //Проверяем совпадают ли введенные пользователем данные с сохраненными
            $loginInfo = $_SESSION['loginInfo'] ?? [];
            if (!empty(array_intersect_assoc($this->users, $loginInfo))) {
                $_SESSION['authorized'] = true;
                $_SESSION['loginTimestamp'] = time() + ConfigDTO::$authSessionLifeTime;
                header("Location: " . ConfigDTO::$homeUrl);
                exit;
            }
            return;
        }
        //если запрос в белом списке - он отдается в роутер.
        if (in_array($this->requestUrl, ConfigDTO::$authWhitelist)) {
            return;
        }
        //проверка сесии на авторизованость, если нет, идет переадресация на /ushellnotpass.
        if ($_SESSION['authorized'] !== true) {
            header("Location: " . ConfigDTO::$accessDeniedPage);
            exit;
        }
        //проверяется таймштамп и сравнивается с тем что сохранен в сессии
        if (time() > $_SESSION['loginTimestamp']) {
            session_destroy();
            header("Location: " . ConfigDTO::$accessDeniedPage);
            exit;
        }
    }
}
