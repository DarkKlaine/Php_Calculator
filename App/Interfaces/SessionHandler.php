<?php

namespace App\Interfaces;

class SessionHandler implements SessionInterface
{
    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public function getIsAuthorized(): bool
    {
        return $_SESSION['isAuthorized'] ?? false;
    }

    public function setIsAuthorized(bool $bool): void
    {
        $_SESSION['isAuthorized'] = $bool;
    }

    public function getDestroyTime(): int
    {
        return $_SESSION['destroyTime'] ?? 0;
    }

    public function setDestroyTime(int $time): void
    {
        $_SESSION['destroyTime'] = $time;
    }
}
