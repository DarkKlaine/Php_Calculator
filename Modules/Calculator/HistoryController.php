<?php

namespace Modules\Calculator;

use Engine\Controllers\BaseController;

class HistoryController extends BaseController
{
    public function showGeneral(): void
    {
        $view = $this->container->get(HistoryView::class);
        $historyMaker = $this->container->get(HistoryModel::class);
        $view->render($historyMaker->getGeneralHistoryString());
    }

    public function showPersonal(): void
    {
        $view = $this->container->get(HistoryView::class);
        $historyMaker = $this->container->get(HistoryModel::class);
        $view->render($historyMaker->getSessionHistoryString());
    }
}
