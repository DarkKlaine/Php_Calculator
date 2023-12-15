<?php

namespace Modules\Calculator\Controllers\ConsoleControllers;

use Engine\Controllers\ConsoleBaseController;
use Modules\Calculator\Models\HistoryModel\HistoryModel;
use Psr\Log\LoggerInterface;

class ConsoleHistoryController extends ConsoleBaseController implements IConsoleHistoryController
{
    private IConsoleHistoryView $historyView;
    private HistoryModel $historyModel;

    public function __construct(
        LoggerInterface $logger,
        HistoryModel $historyModel,
        IConsoleHistoryView $consoleHistoryView,
    ) {
        parent::__construct($logger);
        $this->historyView = $consoleHistoryView;
        $this->historyModel = $historyModel;
    }

    public function showGeneralHistory(): void
    {
        $this->historyView->display($this->historyModel->getGeneralHistoryString(false));
    }

    public function showDBHistory(): void
    {
        $this->historyView->display($this->historyModel->getDBHistoryString(false));
    }
}
