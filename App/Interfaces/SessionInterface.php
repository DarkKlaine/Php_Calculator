<?php

namespace App\Interfaces;

interface SessionInterface
{
    public function getIsAuthorized(): bool;
    public function setIsAuthorized(bool $bool): void;
    public function getDestroyTime(): int;
    public function setDestroyTime(int $time): void;
}