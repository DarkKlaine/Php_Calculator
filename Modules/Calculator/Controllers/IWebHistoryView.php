<?php

namespace Modules\Calculator\Controllers;

interface IWebHistoryView
{
    public function render(string $history): void;
}