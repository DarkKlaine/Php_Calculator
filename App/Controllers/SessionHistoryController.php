<?php

namespace App\Controllers;

use App\DTO\Request;
use App\Models\Logger\HistoryMaker;
use App\Views\HistoryView;

class SessionHistoryController extends BaseController
{
    public function run(Request $request): void
    {
        $view = new HistoryView();
        $historyMaker = new HistoryMaker();
        $view->render($historyMaker->getSessionHistoryString());
    }

}