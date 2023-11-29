<?php

namespace Modules\Calculator\Controllers\WebControllers;

use Engine\Services\Routers\WebRouter\IWebRedirectHandler;
use Engine\Services\Routers\WebRouter\WebRequestDTO;
use Modules\Calculator\Controllers\ICalculatorModel;
use Modules\Calculator\Models\HistoryModel\IHistoryDecorator;
use Modules\Calculator\Services\ConfigManager\ICalculatorConfigManagerWeb;

class WebCalculatorController implements IWebCalculatorController
{
    private IHistoryDecorator $webHistoryModel;
    private ICalculatorModel $calculatorModel;
    private IWebCalculatorView $calculatorView;
    private string $calculatorUrl;
    private IWebRedirectHandler $redirectHandler;

    public function __construct(
        IWebRedirectHandler $redirectHandler,
        ICalculatorConfigManagerWeb   $configManager,
        ICalculatorModel    $calculatorModel,
        IHistoryDecorator   $webHistoryDecorator,
        IWebCalculatorView  $calculatorView,
    )
    {
        $this->webHistoryModel = $webHistoryDecorator;
        $this->calculatorModel = $calculatorModel;
        $this->calculatorView = $calculatorView;
        $this->calculatorUrl = $configManager->getCalculatorUrl();
        $this->redirectHandler = $redirectHandler;
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

        $result = $this->calculatorModel->getResult($inputDataString);

        $this->webHistoryModel->addToHistory($inputDataString, $result);

        $encodedInput = urlencode($inputDataString);
        $encodedResult = urlencode($result);
        $url = $this->calculatorUrl . sprintf("/?input=%s&result=%s", $encodedInput, $encodedResult);
        $this->redirectHandler->redirect($url);
    }
}
