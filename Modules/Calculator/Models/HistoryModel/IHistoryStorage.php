<?php

namespace Modules\Calculator\Models\HistoryModel;

interface IHistoryStorage
{
    public function addHistory(string $expression, string $username): void;

    public function getUserHistory(string $username): ?array;

    public function getAllHistory(): array;
}
