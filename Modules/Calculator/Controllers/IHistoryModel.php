<?php

namespace Modules\Calculator\Controllers;

interface IHistoryModel
{
    public function addToHistory(string $input, string $result, bool $needSessionHistory): void;

    public function getGeneralHistoryString(): string;

    public function getSessionHistoryString(): string;
}