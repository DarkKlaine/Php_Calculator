<?php

namespace Modules\Calculator\Controllers\WebControllers;

use Engine\Services\RedirectHandler\IWebRedirectHandler;
use Engine\Services\Routers\WebRouter\WebRequestDTO;
use Modules\Calculator\Models\CalculatorModel\CalculatorModel;
use Modules\Calculator\Models\HistoryModel\HistoryModel;
use Modules\Calculator\Views\ICalculatorConfigManagerWeb;
use Modules\Calculator\Views\WebCalculatorView;

class WebCalculatorController
{
    private HistoryModel $historyModel;
    private CalculatorModel $calculatorModel;
    private WebCalculatorView $calculatorView;
    private string $calculatorUrl;
    private IWebRedirectHandler $redirectHandler;

    public function __construct(
        IWebRedirectHandler $redirectHandler,
        ICalculatorConfigManagerWeb $configManager,
        CalculatorModel $calculatorModel,
        HistoryModel $historyModel,
        WebCalculatorView $calculatorView,
    ) {
        $this->historyModel = $historyModel;
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

        $this->historyModel->addToHistory($inputDataString, $result);

        $queryParams = [
            'input' => $inputDataString,
            'result' => $result
        ];
        $postData = http_build_query($queryParams);

        $url = $this->calculatorUrl . '/?' . $postData;
        $this->redirectHandler->redirect($url);
    }
}
