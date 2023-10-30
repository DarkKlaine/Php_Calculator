<?php

namespace App\Controllers;

use App\Models\Logger\HistoryMaker;
use App\Views\HistoryView;

class HistoryController extends BaseController
{
    public function showGeneral(): void
    {
        $view = new HistoryView();
        $historyMaker = new HistoryMaker();
        $view->render($historyMaker->getGeneralHistoryString());
    }

    public function showPersonal(): void
    {
        $view = new HistoryView();
        $historyMaker = new HistoryMaker();
        $view->render($historyMaker->getSessionHistoryString());
    }

}