<?php

namespace App;

interface IHistoryProvider
{
    public function addHistory(string $expression, string $username): void;

    public function getUserHistory(string $username): ?array;

    public function getAllHistory(): array;
}
