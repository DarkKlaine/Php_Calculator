<?php

namespace Modules\Calculator\Controllers;

use Engine\Controllers\ConsoleBaseController;
use Engine\DTO\ConsoleRequestDTO;
use JetBrains\PhpStorm\NoReturn;
use Psr\Log\LoggerInterface;

class ConsoleCalculatorController extends ConsoleBaseController implements IConsoleCalculatorController
{
    private ICalculatorModel $calculatorModel;
    private IHistoryModel $historyModel;
    private IConsoleCalculatorView $consoleCalculatorView;

    public function __construct(
        LoggerInterface $logger,
        ICalculatorModel $calculatorModel,
        IHistoryModel $historyModel,
        IConsoleCalculatorView $consoleCalculatorView,
    )
    {
        parent::__construct($logger);
        $this->calculatorModel = $calculatorModel;
        $this->historyModel = $historyModel;
        $this->consoleCalculatorView = $consoleCalculatorView;
    }

    #[NoReturn] public function calculate(ConsoleRequestDTO $request): void
    {
        $inputData = $request->getInputData();
        $result = $this->calculatorModel->countIt($inputData);
        $inputDataToString = implode(' ', $inputData);
        $this->historyModel->addToHistory($inputDataToString, $result, false);
        $this->consoleCalculatorView->display($inputDataToString, $result);
    }
}
