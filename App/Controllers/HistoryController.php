<?php

namespace App\Controllers;

use App\Models\Logger\HistoryMaker;
use App\Views\CalculatorView;

class HistoryController extends BaseController
{
    public function run(): void
    {
        $view = new CalculatorView();
        $view->renderHistory($this->getHistory());
    }

    public function getHistory(): string
    {
        $historyMaker = new HistoryMaker();
        return $historyMaker->createHistoryString();
    }
}