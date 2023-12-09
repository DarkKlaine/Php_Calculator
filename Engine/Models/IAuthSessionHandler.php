<?php

namespace Engine\Models;

interface IAuthSessionHandler
{
    public function getIsAuthorized(): bool;

    public function setIsAuthorized(bool $bool): void;

    public function getDestroyTime(): int;

    public function setDestroyTime(int $time): void;

    public function setRole(string $role): void;

    public function getRole(): string;

    public function setUsername(string $username): void;

    public function getUsername(): string;
}
