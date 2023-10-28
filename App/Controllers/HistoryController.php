<?php

namespace App\Controllers;

use App\Models\Logger\HistoryMaker;
use App\Views\CalculatorView;
use App\Views\HistoryView;

class HistoryController extends BaseController
{
    public function run(object $serverGlobalDTO): void
    {
        $view = new HistoryView();
        $historyMaker = new HistoryMaker();
        $view->render($historyMaker->getHistoryString());
    }

}