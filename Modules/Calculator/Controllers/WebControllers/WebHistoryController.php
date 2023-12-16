<?php

namespace Modules\Calculator\Controllers\WebControllers;

use Modules\Calculator\Models\HistoryModel\HistoryModel;
use Modules\Calculator\Views\WebDBHistoryView;
use Modules\Calculator\Views\WebDBUserHistoryView;

class WebHistoryController
{
    private IWebHistoryView $historyView;
    private HistoryModel $historyModel;
    private WebDBHistoryView $webDBHistoryView;
    private WebDBUserHistoryView $webDBUserHistoryView;

    public function __construct(
        IWebHistoryView $historyView,
        HistoryModel $webHistoryDecorator,
        WebDBHistoryView $webDBHistoryView,
        WebDBUserHistoryView $webDBUserHistoryView
    ) {
        $this->historyView = $historyView;
        $this->historyModel = $webHistoryDecorator;
        $this->webDBHistoryView = $webDBHistoryView;
        $this->webDBUserHistoryView = $webDBUserHistoryView;
    }

    public function showDB(): void
    {
        $this->historyView->render($this->historyModel->getDBHistoryString(true));
    }

    public function showHistory(): void
    {
        $this->webDBHistoryView->render($this->historyModel->getAllHistory());
    }

    public function showUserHistory(): void
    {
        $this->webDBUserHistoryView->render($this->historyModel->getUserHistory());
    }
}
