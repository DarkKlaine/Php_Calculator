<?php

namespace Modules\Calculator\Controllers\WebControllers;

use Engine\Controllers\WebBaseController;
use Engine\Services\Routers\WebRouter\IWebConfigManager;
use Engine\Services\Routers\WebRouter\IWebRedirectHandler;
use Engine\Services\Routers\WebRouter\WebRequestDTO;
use Modules\Calculator\Controllers\ICalculatorModel;
use Modules\Calculator\Models\HistoryModel\IHistoryDecorator;
use Psr\Log\LoggerInterface;

class WebCalculatorController extends WebBaseController implements IWebCalculatorController
{
    private IHistoryDecorator $webHistoryModel;
    private ICalculatorModel $calculatorModel;
    private IWebCalculatorView $calculatorView;

    public function __construct(
        IWebRedirectHandler $redirectHandler,
        LoggerInterface     $logger,
        IWebConfigManager   $configManager,
        ICalculatorModel    $calculatorModel,
        IHistoryDecorator   $webHistoryDecorator,
        IWebCalculatorView  $calculatorView,
    )
    {
        parent::__construct($redirectHandler, $logger, $configManager);
        $this->webHistoryModel = $webHistoryDecorator;
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

        $this->webHistoryModel->addToHistory($inputDataString, $result);

        $encodedInput = urlencode($inputDataString);
        $encodedResult = urlencode($result);
        $this->redirectHandler->redirect(sprintf("/?input=%s&result=%s", $encodedInput, $encodedResult));
    }
}
