<?php

namespace Modules\Calculator\Controllers\WebControllers;

interface IWebHistoryView
{
    public function render(string $history): void;
}
