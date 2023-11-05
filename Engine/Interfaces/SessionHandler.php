<?php

namespace Engine\Interfaces;

class SessionHandler implements SessionInterface
{
    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public function get(string $key):mixed
    {
        return $_SESSION[$key] ?? null;
    }

    public function set(string $key, mixed $value):void
    {
        $_SESSION[$key] = $value;
    }
}