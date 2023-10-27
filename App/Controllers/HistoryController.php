<?php

namespace App\Controllers;

use App\Models\Logger\HistoryMaker;
use App\Views\CalculatorView;

class HistoryController extends BaseController
{
    public function run(object $serverGlobalDTO): void
    {
        $view = new CalculatorView();
        $historyMaker = new HistoryMaker();
        $view->renderHistory($historyMaker->getHistoryString());
    }

}