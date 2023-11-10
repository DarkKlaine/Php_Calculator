<?php

namespace Modules\Calculator\Controllers;

use Engine\Controllers\BaseController;
use Engine\Router\IWebConfigManager;
use Engine\Router\IWebRedirectHandler;
use Psr\Log\LoggerInterface;

class HistoryController extends BaseController implements IHistoryController
{
    private IHistoryView $historyView;
    private IHistoryModel $historyModel;

    public function __construct(
        IWebRedirectHandler $redirectHandler,
        LoggerInterface     $logger,
        IWebConfigManager   $configManager,
        IHistoryView        $historyView,
        IHistoryModel       $historyModel,
    )
    {
        parent::__construct($redirectHandler, $logger, $configManager);
        $this->historyView = $historyView;
        $this->historyModel = $historyModel;
    }

    public function showGeneral(): void
    {
        $this->historyView->render($this->historyModel->getGeneralHistoryString());
    }

    public function showPersonal(): void
    {
        $this->historyView->render($this->historyModel->getSessionHistoryString());
    }
}
