<?php

namespace Modules\Calculator\Controllers\WebControllers;

use Engine\Controllers\WebBaseController;
use Engine\Services\Routers\WebRouter\IWebConfigManager;
use Engine\Services\Routers\WebRouter\IWebRedirectHandler;
use Modules\Calculator\Controllers\IHistoryModel;
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
        IHistoryModel       $webHistoryDecorator,
    )
    {
        parent::__construct($redirectHandler, $logger, $configManager);
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

//    public function showDB(): void
//    {
//        $this->historyView->render($this->historyModel->getDBHistoryString(true));
//    }
}
