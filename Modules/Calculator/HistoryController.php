<?php

namespace Modules\Calculator;

use Engine\Controllers\BaseController;

class HistoryController extends BaseController implements IHistoryController
{
    public function showGeneral(): void
    {
        $view = $this->container->get(IHistoryView::class);
        $historyMaker = $this->container->get(IHistoryModel::class);
        $view->render($historyMaker->getGeneralHistoryString());
    }

    public function showPersonal(): void
    {
        $view = $this->container->get(IHistoryView::class);
        $historyMaker = $this->container->get(IHistoryModel::class);
        $view->render($historyMaker->getSessionHistoryString());
    }
}
