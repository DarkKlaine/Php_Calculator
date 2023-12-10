<?php

namespace Modules\Calculator\Controllers\WebControllers;

use Modules\Calculator\Controllers\IHistoryModel;

class WebHistoryController implements IWebHistoryController
{
    private IWebHistoryView $historyView;
    private IHistoryModel $historyModel;

    public function __construct(
        IWebHistoryView $historyView,
        IHistoryModel $webHistoryDecorator,
    ) {
        $this->historyView = $historyView;
        $this->historyModel = $webHistoryDecorator;
    }

    public function showGeneral(): void
    {
        $this->historyView->render($this->historyModel->getGeneralHistoryString(true));
    }

    public function showPersonal(): void
    {
        $this->historyView->render($this->historyModel->getSessionHistoryString(true));
    }

    public function showDB(): void
    {
        $this->historyView->render($this->historyModel->getDBHistoryString(true));
    }
}
