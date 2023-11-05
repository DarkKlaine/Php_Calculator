<?php

namespace Modules\Calculator;

use Engine\Controllers\BaseController;

class HistoryController extends BaseController
{
    public function showGeneral(): void
    {
        $view = new HistoryView();
        $historyMaker = new HistoryModel();
        $view->render($historyMaker->getGeneralHistoryString());
    }

    public function showPersonal(): void
    {
        $view = new HistoryView();
        $historyMaker = new HistoryModel();
        $view->render($historyMaker->getSessionHistoryString());
    }
}
