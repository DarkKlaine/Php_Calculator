<?php

namespace Modules\Calculator\Models\HistoryModel;

interface IHistoryStorage
{
    public function addToHistory(string $expression, string $userId): void;

    public function getUserHistory(int $userId): array;

    public function getAllHistory(): array;
}
