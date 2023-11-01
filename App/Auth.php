<?php

namespace App;

class Auth
{
    private array $users;
    private array $whiteList;
    private string $accessDeniedPage;
    private string $loginPage;
    private int $sessionLifeTime;
    private string $requestUrl;

    public function __construct($appConfig)
    {
        $this->users = require_once('../Config/users.php');
        $this->accessDeniedPage = $appConfig['authWhitelist']['accessDenied'];
        $this->loginPage = $appConfig['authWhitelist']['login'];
        $this->whiteList = $appConfig['authWhitelist'];
        $this->sessionLifeTime = $appConfig['authSessionLifeTime'];
        $this->requestUrl = strtok($_SERVER['REQUEST_URI'], '?');
    }

    public function verifyAuth(): void
    {
        //Если запрос ведет на логин, обрабатываем
        if ($this->requestUrl === $this->loginPage) {
            if ($_POST) {
                $_SESSION['loginInfo'] = [$_POST['username'] => $_POST['password']];
            }

            if (isset($_SESSION['loginInfo']) === false) {
                return;
            }

            if (!empty(array_intersect_assoc($this->users, $_SESSION['loginInfo']))) {
                $_SESSION['authorized'] = true;
                $_SESSION['loginTimestamp'] = time();
                header("Location: " . Application::$homeUrl);
                exit;
            }
            return;
        }
        //если запрос в белом списке - он отдается в роутер.
        if (in_array($this->requestUrl, $this->whiteList)) {
            return;
        }
        //проверка сесии на авторизованость ('authorized' => true), если нет, идет переадресация на /ushellnotpass.
        if ($_SESSION['authorized'] !== true) {
            header("Location: $this->accessDeniedPage");
            exit;
        }
        //проверяется таймштамп и сравнивается с тем что сохранен в сессии
        //если прошло более 5 минут, сессия рушится и идет переадресация на /ushellnotpass.
        if (time() - $_SESSION['loginTimestamp'] > $this->sessionLifeTime) {
            session_destroy();
            header("Location: $this->accessDeniedPage");
            exit;
        }
    }
}
