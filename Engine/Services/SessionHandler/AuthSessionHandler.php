<?php

namespace Engine\Services\SessionHandler;

use Engine\Models\IAuthSessionHandler;

class AuthSessionHandler extends SessionHandler implements IAuthSessionHandler
{
    private const IS_AUTHORIZED = 'isAuthorized';
    private const DESTROY_TIME = 'destroyTime';
    private const USERNAME = 'username';
    private const USER_ID = 'userID';
    private const ROLE = 'role';

    public function sessionDestroy(): void
    {
        session_destroy();
    }

    public function getIsAuthorized(): bool
    {
        return $this->get(self::IS_AUTHORIZED) ?? false;
    }

    public function setIsAuthorized(bool $bool): void
    {
        $this->set(self::IS_AUTHORIZED, $bool);
    }

    public function getDestroyTime(): int
    {
        return $this->get(self::DESTROY_TIME) ?? 0;
    }

    public function setDestroyTime(int $time): void
    {
        $this->set(self::DESTROY_TIME, $time);
    }

    public function setUsername(string $username): void
    {
        $this->set(self::USERNAME, $username);
    }

    public function getUsername(): string
    {
        return $this->get(self::USERNAME) ?? '';
    }

    public function setUserID(string $userID): void
    {
        $this->set(self::USER_ID, $userID);
    }

    public function getUserID(): string
    {
        return $this->get(self::USER_ID) ?? '';
    }

    public function setRole(string $role): void
    {
        $this->set(self::ROLE, $role);
    }

    public function getRole(): string
    {
        return $this->get(self::ROLE) ?? '';
    }
}
