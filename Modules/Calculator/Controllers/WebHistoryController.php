<?php

namespace Modules\Calculator\Controllers;

use Engine\Controllers\WebBaseController;
use Engine\Router\IWebConfigManager;
use Engine\Router\IWebRedirectHandler;
use Modules\Calculator\Models\IHistoryModel;
use Psr\Log\LoggerInterface;

class WebHistoryController extends WebBaseController implements IWebHistoryController
{
    private IWebHistoryView $historyView;
    private IHistoryModel $historyModel;

    public function __construct(
        IWebRedirectHandler $redirectHandler,
        LoggerInterface     $logger,
        IWebConfigManager   $configManager,
        IWebHistoryView     $historyView,
        IHistoryModel       $historyModel,
    )
    {
        parent::__construct($redirectHandler, $logger, $configManager);
        $this->historyView = $historyView;
        $this->historyModel = $historyModel;
    }

    public function showGeneral(): void
    {
        $this->historyView->render($this->historyModel->getGeneralHistoryString(true));
    }

    public function showPersonal(): void
    {
        $this->historyView->render($this->historyModel->getSessionHistoryString(true));
    }
}
