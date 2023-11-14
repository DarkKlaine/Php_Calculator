<?php
namespace Modules\Calculator\Models\HistoryModel;
interface IHistoryDecorator
{
    public function addToHistory(string $input, string $result): void;
}

