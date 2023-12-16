<?php

namespace Modules\Calculator\Controllers\ConsoleControllers;

use Engine\Controllers\ConsoleBaseController;
use Engine\Services\Routers\ConsoleRouter\ConsoleRequestDTO;
use JetBrains\PhpStorm\NoReturn;
use Modules\Calculator\Models\CalculatorModel\CalculatorModel;
use Modules\Calculator\Models\HistoryModel\HistoryModel;
use Psr\Log\LoggerInterface;

class ConsoleCalculatorController extends ConsoleBaseController implements IConsoleCalculatorController
{
    private CalculatorModel $calculatorModel;
    private HistoryModel $historyModel;
    private IConsoleCalculatorView $consoleCalculatorView;

    public function __construct(
        LoggerInterface $logger,
        CalculatorModel $calculatorModel,
        HistoryModel $historyModel,
        IConsoleCalculatorView $consoleCalculatorView,
    ) {
        parent::__construct($logger);
        $this->calculatorModel = $calculatorModel;
        $this->historyModel = $historyModel;
        $this->consoleCalculatorView = $consoleCalculatorView;
    }

    #[NoReturn] public function calculate(ConsoleRequestDTO $request): void
    {
        $inputData = $request->getInputData();
        $inputDataToString = implode('', $inputData);
        $result = $this->calculatorModel->getResult($inputDataToString);
        $this->historyModel->addToHistory($inputDataToString, $result);
        $this->consoleCalculatorView->display($inputDataToString, $result);
    }
}
