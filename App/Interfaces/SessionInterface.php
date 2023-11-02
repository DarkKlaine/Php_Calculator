<?php

namespace App\Interfaces;

interface SessionInterface
{
    public function getLoginInfo(): array;

    public function setLoginInfo(array $arr): void;

    public function getIsAuthorized(): bool;

    public function setIsAuthorized(bool $bool): void;

    public function getLoginTime(): int;

    public function setLoginTime(int $time): void;
}