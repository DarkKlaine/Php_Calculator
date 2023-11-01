<?php

namespace App;

class Auth
{
    private array $whiteList;
    private string $uShellNotPassPage = '/ushellnotpass';
    private int $sessionLifeTime;
    private string $requestUrl;

    public function __construct($appConfig)
    {
        $this->whiteList = $appConfig['authWhitelist'];
        $this->sessionLifeTime = $appConfig['authSessionLifeTime'];
        $this->requestUrl = strtok($_SERVER['REQUEST_URI'], '?');
    }

    public function verifyAuth(): void
    {
        //если запрос в белом списке - он отдается в роутер.
        if (in_array($this->requestUrl, $this->whiteList)) {
            return;
        }
        //проверка сесии на авторизованость ('authorized' => true), если нет, идет переадресация на /ushellnotpass.
        if ($_SESSION['authorized'] !== true) {
            header("Location: $this->uShellNotPassPage");
            exit;
        }
        //проверяется таймштамп и сравнивается с тем что сохранен в сессии
        //если прошло более 5 минут, сессия рушится и идет переадресация на /ushellnotpass.
        if (time() - $_SESSION['loginTimestamp'] > $this->sessionLifeTime) {
            session_destroy();
            header("Location: $this->uShellNotPassPage");
            exit;
        }
    }
}