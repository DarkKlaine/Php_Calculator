<?php

namespace App;

use App\DTO\ConfigDTO;
use App\Interfaces\SessionHandler;

class Auth
{
    private array $users;
    private string $requestUrl;
    private SessionHandler $SESSION;

    public function __construct()
    {
        $this->SESSION = new SessionHandler();
        $this->users = require_once('../Config/users.php');
        $this->requestUrl = strtok($_SERVER['REQUEST_URI'], '?');
    }

    public function verifyAuth(): void
    {
        //Если запрос ведет на логин, обрабатываем
        if ($this->requestUrl === ConfigDTO::$loginPage) {
            if ($_POST) {
                $this->SESSION->setLoginInfo([$_POST['username'] => $_POST['password']]);
            }
            //Проверяем совпадают ли введенные пользователем данные с сохраненными
            $loginInfo = $this->SESSION->getLoginInfo() ?? [];
            if (!empty(array_intersect_assoc($this->users, $loginInfo))) {
                $this->SESSION->setIsAuthorized(true);
                $this->SESSION->setLoginTime(time() + ConfigDTO::$authSessionLifeTime);
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
        if ($this->SESSION->getIsAuthorized() !== true) {
            header("Location: " . ConfigDTO::$accessDeniedPage);
            exit;
        }
        //проверяется таймштамп и сравнивается с тем что сохранен в сессии
        if (time() > $this->SESSION->getLoginTime()) {
            session_destroy();
            header("Location: " . ConfigDTO::$accessDeniedPage);
            exit;
        }
    }
}
