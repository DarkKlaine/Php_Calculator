<?php

namespace Modules\Calculator\Controllers;

interface IHistoryModel
{
    public function addToHistory(string $input, string $result): void;

    public function getGeneralHistoryString(): string;

    public function getSessionHistoryString(): string;
}