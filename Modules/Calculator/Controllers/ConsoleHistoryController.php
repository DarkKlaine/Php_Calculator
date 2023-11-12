<?php

namespace Modules\Calculator\Controllers;

use Engine\Controllers\ConsoleBaseController;
use Modules\Calculator\Models\IHistoryModel;
use Psr\Log\LoggerInterface;

class ConsoleHistoryController extends ConsoleBaseController implements IConsoleHistoryController
{
    private IConsoleHistoryView $historyView;
    private IHistoryModel $historyModel;

    public function __construct(
        LoggerInterface     $logger,
        IHistoryModel       $historyModel,
        IConsoleHistoryView $historyView,
    )
    {
        parent::__construct($logger);
        $this->historyView = $historyView;
        $this->historyModel = $historyModel;
    }

    public function showHistory(): void
    {
        $this->historyView->display($this->historyModel->getGeneralHistoryString(false));
    }
}