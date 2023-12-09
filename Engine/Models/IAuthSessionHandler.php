<?php

namespace Engine\Models;

interface IAuthSessionHandler
{
    public function getIsAuthorized(): bool;

    public function setIsAuthorized(bool $bool): void;

    public function getDestroyTime(): int;

    public function setDestroyTime(int $time): void;

    public function setUsername(string $username): void;

    public function getUsername(): string;
}
