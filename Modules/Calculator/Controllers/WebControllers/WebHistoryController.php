<?php

namespace Modules\Calculator\Controllers\WebControllers;

use Modules\Calculator\Models\HistoryModel\HistoryModel;
use Modules\Calculator\Views\WebDBHistoryView;
use Modules\Calculator\Views\WebDBUserHistoryView;

class WebHistoryController
{
    private HistoryModel $historyModel;
    private WebDBHistoryView $webDBHistoryView;
    private WebDBUserHistoryView $webDBUserHistoryView;

    public function __construct(
        HistoryModel $historyModel,
        WebDBHistoryView $webDBHistoryView,
        WebDBUserHistoryView $webDBUserHistoryView
    ) {
        $this->historyModel = $historyModel;
        $this->webDBHistoryView = $webDBHistoryView;
        $this->webDBUserHistoryView = $webDBUserHistoryView;
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
