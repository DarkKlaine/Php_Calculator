<?php

namespace Modules\Calculator\Controllers;

use Engine\Controllers\WebBaseController;
use Engine\DTO\WebRequestDTO;
use Engine\Router\IWebConfigManager;
use Engine\Router\IWebRedirectHandler;
use Psr\Log\LoggerInterface;

class WebCalculatorController extends WebBaseController implements IWebCalculatorController
{
    private IHistoryModel $historyModel;
    private ICalculatorModel $calculatorModel;
    private ICalculatorView $calculatorView;

    public function __construct(
        IWebRedirectHandler $redirectHandler,
        LoggerInterface     $logger,
        IWebConfigManager   $configManager,
        ICalculatorModel    $calculatorModel,
        IHistoryModel       $historyModel,
        ICalculatorView     $calculatorView,
    )
    {
        parent::__construct($redirectHandler, $logger, $configManager);
        $this->historyModel = $historyModel;
        $this->calculatorModel = $calculatorModel;
        $this->calculatorView = $calculatorView;
    }

    public function showForm(WebRequestDTO $request): void
    {
        $get = $request->getGet();

        $input = $get['input'] ?? '';
        $result = $get['result'] ?? '';

        $this->calculatorView->render($input, $result);
    }

    public function calculate(WebRequestDTO $request): void
    {
        $post = $request->getPost();
        $inputDataString = $post['userInput'] ?? '';

        if ($inputDataString === '') {
            return;
        }

        $inputData = explode(' ', $inputDataString);

        $result = $this->calculatorModel->countIt($inputData);

        $this->historyModel->addToHistory($inputDataString, $result, true);

        $encodedInput = urlencode($inputDataString);
        $encodedResult = urlencode($result);
        $this->redirectHandler->redirect(sprintf("/?input=%s&result=%s", $encodedInput, $encodedResult));
    }
}
