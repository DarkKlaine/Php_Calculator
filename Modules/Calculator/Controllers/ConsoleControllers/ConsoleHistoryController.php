<?php

namespace Modules\Calculator\Controllers\ConsoleControllers;

use Engine\Controllers\ConsoleBaseController;
use Modules\Calculator\Models\HistoryModel\HistoryModel;
use Modules\Calculator\Views\ConsoleHistoryView;
use Psr\Log\LoggerInterface;

class ConsoleHistoryController extends ConsoleBaseController
{
    private ConsoleHistoryView $historyView;
    private HistoryModel $historyModel;

    public function __construct(
        LoggerInterface $logger,
        HistoryModel $historyModel,
        ConsoleHistoryView $consoleHistoryView,
    ) {
        parent::__construct($logger);
        $this->historyView = $consoleHistoryView;
        $this->historyModel = $historyModel;
    }

    public function showGeneralHistory(): void
    {
        $this->historyView->display($this->historyModel->getAllHistory());
    }

    public function showDBHistory(): void
    {
        $this->historyView->display($this->historyModel->getUserHistory());
    }
}
