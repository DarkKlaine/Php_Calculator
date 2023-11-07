<?php

namespace Modules\Calculator\Controllers;

use Engine\Container\Container;
use Engine\Controllers\BaseController;
use Engine\Router\IConfigManager;
use Engine\Router\IRedirectHandler;
use Psr\Log\LoggerInterface;

class HistoryController extends BaseController implements IHistoryController
{
    private IHistoryView $historyView;
    private IHistoryModel $historyModel;

    public function __construct(
        IRedirectHandler $redirectHandler,
        LoggerInterface  $logger,
        IConfigManager   $configManager,
        IHistoryView     $historyView,
        IHistoryModel    $historyModel,
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
