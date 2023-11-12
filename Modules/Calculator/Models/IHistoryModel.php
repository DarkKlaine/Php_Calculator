<?php

namespace Modules\Calculator\Models;

interface IHistoryModel
{
    public function addToHistory(string $input, string $result, bool $needSessionHistory): void;

    public function getGeneralHistoryString(bool $isForWeb): string;

    public function getSessionHistoryString(bool $isForWeb): string;
}