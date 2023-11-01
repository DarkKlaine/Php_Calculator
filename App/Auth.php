<?php

namespace App;

class Auth
{
    private bool $authEnabled;
    private array $whiteList;
    private string $uShellNotPassPage = '/ushellnotpass';
    private int $sessionLifeTime;
    private string $requestUrl;

    public function __construct()
    {
        $appConfig = require_once('../Config/app.php');
        $this->authEnabled = $appConfig['authEnabled'];
        $this->whiteList = $appConfig['authWhitelist'];
        $this->sessionLifeTime = $appConfig['authSessionLifeTime'];
        $this->requestUrl = strtok($_SERVER['REQUEST_URI'], '?');
    }

    private function verifyAuth(): void
    {
        //если авторизация отключена, запрос отдается в роутер.
        if ($this->authEnabled === false) {
            return;
        }
        //если запрос в белом списке - он отдается в роутер.
        if (in_array($this->requestUrl, $this->whiteList)) {
            return;
        }
        //проверка сесии на авторизованость ('autorized' => true), если нет, идет переадресация на /ushellnotpass.
        $_SESSION = [];
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

/**Создаю класс Auth в App/.
 * Он будет вызываться перед роутером в Application->run.
 * В нем будет происходить остальная магия:
 * - хранится "белый" список адресов не требующих авторизации (пока что /ushellnotpass и /login)
 * - проверка входящего запроса, есть ли он "белом" списке
 * - если запрос в белом списке - он отдается в роутер.
 * - проверка сесии на авторизованость ('autorized' => true), если нет, идет переадресация на /ushellnotpass.
 * - если авторизация пройдена, проверяется таймштамп и сравнивается с тем что сохранен в сессии,
 *          если прошло более 5 минут, сессия рушится и идет переадресация на /ushellnotpass.
 * - если авторизация пройдена, и таймштампу менее 5 минут, запрос отдается в роутер.*/