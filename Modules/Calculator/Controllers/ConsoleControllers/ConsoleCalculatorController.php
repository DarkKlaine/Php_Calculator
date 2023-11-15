<?php

namespace Modules\Calculator\Controllers\ConsoleControllers;

use Engine\Controllers\ConsoleBaseController;
use Engine\Services\Routers\ConsoleRouter\ConsoleRequestDTO;
use JetBrains\PhpStorm\NoReturn;
use Modules\Calculator\Controllers\ICalculatorModel;
use Modules\Calculator\Models\HistoryModel\IHistoryDecorator;
use Psr\Log\LoggerInterface;

class ConsoleCalculatorController extends ConsoleBaseController implements IConsoleCalculatorController
{
    private ICalculatorModel $calculatorModel;
    private IHistoryDecorator $consoleHistoryModel;
    private IConsoleCalculatorView $consoleCalculatorView;

    public function __construct(
        LoggerInterface        $logger,
        ICalculatorModel       $calculatorModel,
        IHistoryDecorator      $consoleHistoryDecorator,
        IConsoleCalculatorView $consoleCalculatorView,
    )
    {
        parent::__construct($logger);
        $this->calculatorModel = $calculatorModel;
        $this->consoleHistoryModel = $consoleHistoryDecorator;
        $this->consoleCalculatorView = $consoleCalculatorView;
    }

    #[NoReturn] public function calculate(ConsoleRequestDTO $request): void
    {
        $inputData = $request->getInputData();
        $result = $this->calculatorModel->countIt($inputData);
        $inputDataToString = implode(' ', $inputData);
        $this->consoleHistoryModel->addToHistory($inputDataToString, $result);
        $this->consoleCalculatorView->display($inputDataToString, $result);
    }
}
