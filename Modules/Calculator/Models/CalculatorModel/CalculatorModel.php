<?php

namespace Modules\Calculator\Models\CalculatorModel;

use Modules\Calculator\Controllers\ICalculatorModel;
use Modules\Calculator\Models\CalculatorModel\Computations\Addition;
use Modules\Calculator\Models\CalculatorModel\Computations\Divide;
use Modules\Calculator\Models\CalculatorModel\Computations\Exponentiation;
use Modules\Calculator\Models\CalculatorModel\Computations\Multiply;
use Modules\Calculator\Models\CalculatorModel\Computations\SinCosTan;
use Modules\Calculator\Models\CalculatorModel\Computations\Subtraction;
use Psr\Log\LoggerInterface;

class CalculatorModel implements ICalculatorModel
{
    private Addition $addition;
    private Subtraction $subtraction;
    private Multiply $multiply;
    private Divide $divide;
    private Exponentiation $exponentiation;
    private SinCosTan $sinCosTan;
    private LoggerInterface $logger;


    public function __construct(
        LoggerInterface $logger,
        Addition $addition,
        Subtraction $subtraction,
        Multiply $multiply,
        Divide $divide,
        Exponentiation $exponentiation,
        SinCosTan $sinCosTan
    ) {
        $this->addition = $addition;
        $this->subtraction = $subtraction;
        $this->multiply = $multiply;
        $this->divide = $divide;
        $this->exponentiation = $exponentiation;
        $this->sinCosTan = $sinCosTan;
        $this->logger = $logger;
    }

    public function getResult(string $expression): string
    {
        $expression = str_replace(' ', '', $expression);

        $result = $this->processInputExpression($expression);

        $divByZeroMsg = 'Ошибка. Деление на ноль.';
        if (str_contains($result, $divByZeroMsg)) {
            return $divByZeroMsg;
        }

        if (is_numeric($result) === false) {
            $message = "Неправильный ввод, попробуйте снова";
            $this->logger->error($message);

            return $message;
        }

        return $result;
    }

    private function processInputExpression(string $expression): string
    {
        if (str_contains($expression, "(")) {
            $openBracket = strrpos($expression, '(') + 1;
            $closeBracket = strpos($expression, ')', $openBracket) - $openBracket;
            $subExpression = substr($expression, $openBracket, $closeBracket);
            $result = $this->processSubExpression($subExpression);
            $expression = str_replace("($subExpression)", $result, $expression);

            return $this->processInputExpression($expression);
        }

        return $this->processSubExpression($expression);
    }

    private function processSubExpression(string $expression): string
    {
        $expression = $this->processTrigonometry($expression);
        $expression = $this->processExponentiation($expression);
        $expression = $this->processMultiplyAndDivide($expression);

        return $this->processPlusAndMinus($expression);
    }

    private function recursiveProcessExpression(string $expression, string $pattern): string
    {
        if (preg_match($pattern, $expression, $matches)) {
            $subExpression = $matches[0];
            $result = $this->calculateSimpleExpression($subExpression, $pattern);
            $expression = str_replace($subExpression, $result, $expression);

            return $this->recursiveProcessExpression($expression, $pattern);
        }

        return $expression;
    }

    private function calculateSimpleExpression(string $expression, string $pattern): string
    {
        preg_match($pattern, $expression, $matches);
        $value1 = $matches[1] ?? '';
        $operator = $matches[3] ?? '';
        $value2 = $matches[4] ?? '';

        // Массив с операциями
        $operations = [
            '+' => $this->addition,
            '-' => $this->subtraction,
            '*' => $this->multiply,
            '/' => $this->divide,
            'pow' => $this->exponentiation,
            'sin' => $this->sinCosTan,
            'cos' => $this->sinCosTan,
            'tan' => $this->sinCosTan,
        ];

        // Получение класса операции
        $operationClass = $operations[$operator] ?? null;

        // Если класс найден, вызываю getResult()
        if ($operationClass !== null) {
            return $operationClass->getResult($value1, $operator, $value2);
        }

        $message = "Неправильный оператор: " . $operator;
        $this->logger->error($message);

        return $message;
    }

    private function processTrigonometry(string $expression): string
    {
        $pattern = '/(())(?<!\d)(?<!\.)(sin|cos|tan)(-?\d+(\.\d+)?)/';

        return $this->recursiveProcessExpression($expression, $pattern);
    }

    private function processExponentiation(string $expression): string
    {
        $pattern = '/(-?\d+(\.\d+)?)(pow)(-?\d+(\.\d+)?)/';

        return $this->recursiveProcessExpression($expression, $pattern);
    }

    private function processMultiplyAndDivide(string $expression): string
    {
        $pattern = '/(-?\d+(\.\d+)?)([*\/])(-?\d+(\.\d+)?)/';

        return $this->recursiveProcessExpression($expression, $pattern);
    }

    private function processPlusAndMinus(string $expression): string
    {
        $pattern = '/(-?\d+(\.\d+)?)([+\-])(-?\d+(\.\d+)?)/';

        return $this->recursiveProcessExpression($expression, $pattern);
    }
}
