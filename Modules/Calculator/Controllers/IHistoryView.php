<?php

namespace Modules\Calculator\Controllers;

interface IHistoryView
{
    public function render(string $history): void;
}