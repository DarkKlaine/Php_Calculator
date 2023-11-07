<?php

namespace Modules\Calculator;

interface IHistoryView
{
    public function render($history): void;
}