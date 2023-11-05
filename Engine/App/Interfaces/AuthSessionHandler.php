<?php

namespace Engine\App\Interfaces;

class AuthSessionHandler extends SessionHandler
{
    public function getIsAuthorized(): bool
    {
        return $this->get('isAuthorized') ?? false;
    }

    public function setIsAuthorized(bool $bool): void
    {
        $this->set('isAuthorized', $bool);
    }

    public function getDestroyTime(): int
    {
        return $this->get('destroyTime') ?? 0;
    }

    public function setDestroyTime(int $time): void
    {
        $this->set('destroyTime', $time);
    }
}
