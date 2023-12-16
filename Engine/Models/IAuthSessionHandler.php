<?php

namespace Engine\Models;

interface IAuthSessionHandler
{
    public function sessionDestroy(): void;

    public function getAuthStatus(): bool;

    public function setAuthStatus(bool $bool): void;

    public function getDestroyTime(): int;

    public function setDestroyTime(int $time): void;

    public function setUsername(string $username): void;

    public function getUsername(): string;

    public function setUserID(int $userID): void;

    public function getUserID(): int;

    public function setRole(string $role): void;

    public function getRole(): string;
}
