<?php

namespace Engine\Models;

interface IAuthSessionHandler
{
    public function getIsAuthorized(): bool;

    public function setIsAuthorized(bool $bool): void;

    public function getDestroyTime(): int;

    public function setDestroyTime(int $time): void;
}