<?php

namespace Modules\Calculator;

use Engine\Controllers\BaseController;
use Engine\DTO\Request;
use JetBrains\PhpStorm\NoReturn;

class CalculatorController extends BaseController implements ICalculatorController
{
    private string $input = '';
    private string $result = '';

    private string $inputPattern = '/^-?\d+(\.\d+)? (([+\-\/*]|pow) -?\d+(\.\d+)?|sin|cos|tan)$/';

    public function showForm(Request $request): void
    {
        $get = $request->getGet();

        $input = $get['input'] ?? '';
        $result = $get['result'] ?? '';

        $view = $this->container->get(ICalculatorView::class);
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
        if (preg_match($this->inputPattern, $this->input)) {
            [$value1, $operator, $value2] = explode(' ', $this->input);

            $operations = [
                '+' => IAddition::class,
                '-' => ISubtraction::class,
                '*' => IMultiply::class,
                '/' => IDivide::class,
                'pow' => IExponentiation::class,
                'sin' => ISinCosTan::class,
                'cos' => ISinCosTan::class,
                'tan' => ISinCosTan::class,
            ];

            if (empty($operations[$operator])) {
                $this->result = "Error. Incorrect operator.";
                $this->logger->error('Ошибка. Неправильный математический оператор.');
            } else {
                $className = $operations[$operator];
                $operation = $this->container->get($className);
                $this->result = $operation->getResult($value1, $operator, $value2 ?? '');
            }
        } else {
            $this->result = "Error. Wrong input! Try again.";
            $this->logger->error("Неправильный ввод: $this->input");
        }
        $historyMaker = $this->container->get(IHistoryModel::class);
        $historyMaker->addToHistory($this->input, $this->result);
    }
}
