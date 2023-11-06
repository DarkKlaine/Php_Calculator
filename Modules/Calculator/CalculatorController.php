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

    public function showForm(Request $request): void
    {
        $get = $request->getGet();

        $input = $get['input'] ?? '';
        $result = $get['result'] ?? '';

        $view = $this->container->get(CalculatorView::class);
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
        $logger = $this->container->get(EngineLogger::class);
        if (preg_match($this->inputPattern, $this->input)) {
            [$value1, $operator, $value2] = explode(' ', $this->input);

            $operations = [
                '+' => Addition::class,
                '-' => Subtraction::class,
                '*' => Multiply::class,
                '/' => Divide::class,
                'pow' => Exponentiation::class,
                'sin' => SinCosTan::class,
                'cos' => SinCosTan::class,
                'tan' => SinCosTan::class,
            ];

            if (empty($operations[$operator])) {
                $this->result = "Error. Incorrect operator.";
                $logger->error('Ошибка. Неправильный математический оператор.');
            } else {
                $className = $operations[$operator];
                $operation = $this->container->get($className);
                $this->result = $operation->getResult($value1, $operator, $value2 ?? '');
            }
        } else {
            $this->result = "Error. Wrong input! Try again.";
            $logger->error("Неправильный ввод: $this->input");
        }
        $historyMaker = $this->container->get(HistoryModel::class);
        $historyMaker->addToHistory($this->input, $this->result);
    }
}
