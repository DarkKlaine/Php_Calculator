<?php

namespace Modules\Calculator\Controllers\ConsoleControllers;

use Engine\Controllers\ConsoleBaseController;
use Modules\Calculator\Controllers\IHistoryModel;
use Psr\Log\LoggerInterface;

class ConsoleHistoryController extends ConsoleBaseController implements IConsoleHistoryController
{
    private IConsoleHistoryView $historyView;
    private IHistoryModel $historyModel;

    public function __construct(
        LoggerInterface $logger,
        IHistoryModel $historyModel,
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
