<?php

namespace Engine\Services\SessionHandler;

use Engine\Models\IAuthSessionHandler;

class AuthSessionHandler extends SessionHandler implements IAuthSessionHandler
{
    public function getIsAuthorized(): bool
    {
        return $this->get('isAuthorized') ?? false;
    }

    public function setIsAuthorized(bool $bool): void
    {
        $this->set('isAuthorized', $bool);
    }

    public function setRole(string $role): void
    {
        $this->set('role', $role);
    }

    public function getRole(): string
    {
        return $this->get('role') ?? '';
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
