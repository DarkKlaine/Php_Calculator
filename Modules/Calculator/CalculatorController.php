<?php

namespace Modules\Calculator;

use Engine\Controllers\BaseController;
use Engine\DTO\Request;
use Engine\Interfaces\RedirectHandler;
use Engine\Models\Logger\EngineLogger;
use JetBrains\PhpStorm\NoReturn;
use Modules\Calculator\Computations\Addition;
use Modules\Calculator\Computations\Divide;
use Modules\Calculator\Computations\Exponentiation;
use Modules\Calculator\Computations\Multiply;
use Modules\Calculator\Computations\SinCosTan;
use Modules\Calculator\Computations\Subtraction;


class CalculatorController extends BaseController
{
    private string $input = '';
    private string $result = '';

    private string $inputPattern = '/^-?\d+(\.\d+)? (([+\-\/*]|pow) -?\d+(\.\d+)?|sin|cos|tan)$/';


    public function __construct($container)
    {

    }

    public function showForm(Request $request): void
    {
        $get = $request->getGet();

        $input = $get['input'] ?? '';
        $result = $get['result'] ?? '';

        $view = new CalculatorView();
        $view->render($input, $result);
    }

    #[NoReturn] public function calculate(Request $request): void
    {
        $post = $request->getPost();
        if (isset($post['userInput'])) {
            $this->input = $post['userInput'];
            $this->countIt();
        }
        $encodedInput = urlencode($this->input);
        $encodedResult = urlencode($this->result);
        $this->redirectHandler->redirect(sprintf("/?input=%s&result=%s", $encodedInput, $encodedResult));
    }

    private function countIt(): void
    {
        $logger = new EngineLogger();
        if (preg_match($this->inputPattern, $this->input)) {
            $inputData = explode(' ', $this->input);

            if ($inputData[1] == "+") {
                $this->result = (new Addition($inputData[0], $inputData[1], $inputData[2]))->getResult();
            } elseif ($inputData[1] == "-") {
                $this->result = (new Subtraction($inputData[0], $inputData[1], $inputData[2]))->getResult();
            } elseif ($inputData[1] == "*") {
                $this->result = (new Multiply($inputData[0], $inputData[1], $inputData[2]))->getResult();
            } elseif ($inputData[1] == "/") {
                $this->result = (new Divide($inputData[0], $inputData[1], $inputData[2]))->getResult();
            } elseif ($inputData[1] == "pow") {
                $this->result = (new Exponentiation($inputData[0], $inputData[1], $inputData[2]))->getResult();
            } elseif ($inputData[1] == "sin" || $inputData[1] == "cos" || $inputData[1] == "tan") {
                $this->result = (new SinCosTan($inputData[0], $inputData[1]))->getResult();
            } else {
                $this->result = "Error. Incorrect operator.";
                $logger->error('Ошибка. Неправильный математический оператор.');
            }
        } else {
            $this->result = "Error. Wrong input! Try again.";
            $logger->error("Неправильный ввод: $this->input");
        }
        $historyMaker = new HistoryModel();
        $historyMaker->addToHistory($this->input, $this->result);
    }
}
