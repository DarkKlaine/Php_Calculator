<?php

namespace App\Interfaces;

class SessionHandler
{
    public function __construct()
    {
        session_start();
    }

    public function getLoginInfo(): array
    {
        return $_SESSION['loginInfo'] ?? [];
    }

    public function setLoginInfo(array $arr): void
    {
        $_SESSION['loginInfo'] = $arr;
    }

    public function getIsAuthorized(): bool
    {
        return $_SESSION['isAuthorized'] ?? false;
    }

    public function setIsAuthorized(bool $bool): void
    {
        $_SESSION['isAuthorized'] = $bool;
    }

    public function getLoginTime(): int
    {
        return $_SESSION['loginTime'] ?? 0;
    }

    public function setLoginTime(int $time): void
    {
        $_SESSION['loginTime'] = $time;
    }
}
