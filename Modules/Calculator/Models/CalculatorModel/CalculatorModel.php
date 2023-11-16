<?php

namespace Modules\Calculator\Models\CalculatorModel;

use Modules\Calculator\Controllers\ICalculatorModel;
use Psr\Log\LoggerInterface;

class CalculatorModel implements ICalculatorModel
{
    private IAddition $addition;
    private ISubtraction $subtraction;
    private IMultiply $multiply;
    private IDivide $divide;
    private IExponentiation $exponentiation;
    private ISinCosTan $sinCosTan;
    private LoggerInterface $logger;


    public function __construct(
        LoggerInterface $logger,
        IAddition       $addition,
        ISubtraction    $subtraction,
        IMultiply       $multiply,
        IDivide         $divide,
        IExponentiation $exponentiation,
        ISinCosTan      $sinCosTan
    )
    {
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
        // Удаляем пробелы
        $expression = str_replace(' ', '', $expression);
        // Проверка валидности входных данных
//        if ($this->isValidInput($expression) === false) {
//            $message = "Неправильный ввод, попробуйте снова";
//            $this->logger->error($message);
//            return $message;
//        }

        $result = $this->processInputExpression($expression);

        if (!is_numeric($result)) {
            $message = "Неправильный ввод, попробуйте снова";
            $this->logger->error($message);
            return $message;
        }

        return $result;
    }

//    private function isValidInput(string $expression): bool
//    {
//        $pattern = '/^([0-9.()+\-*\/]|pow|sin|cos|tan)+$/';
//        if (preg_match($pattern, $expression) === false) {
//            return false;
//        }
//
//        $openBracketCount = 0;
//        $closeBracketCount = 0;
//
//        for ($i = 0; $i < strlen($expression); $i++) {
//            $char = $expression[$i];
//
//            if ($char === '(') {
//                $openBracketCount++;
//            } elseif ($char === ')') {
//                $closeBracketCount++;
//            }
//        }
//
//        if ($openBracketCount === $closeBracketCount) {
//            return true;
//        }
//        return false;
//    }

    private function processInputExpression(string $expression): string
    {
        $openBracket = strrpos($expression, '(') + 1;
        $closeBracket = strpos($expression, ')', $openBracket) - $openBracket;
        $subExpression = substr($expression, $openBracket, $closeBracket);
        $result = $this->processSubExpression($subExpression);
        $expression = str_replace("($subExpression)", $result, $expression);

        if (str_contains($expression, "(")) {
            return $this->processInputExpression($expression);
        }

        return $this->processSubExpression($expression);
    }

    private function processSubExpression(string $expression): string
    {
        $expression = $this->calculateTrigonometry($expression);
        $expression = $this->calculateExponentiation($expression);
        $expression = $this->calculateMultiplyAndDivide($expression);
        return $this->calculatePlusAndMinus($expression);
    }

    private function calculateExpression(string $expression, string $pattern): string
    {
        if (preg_match($pattern, $expression, $matches)) {
            $subExpression = $matches[0];
            $result = $this->countIt($subExpression, $pattern);
            $expression = str_replace($subExpression, $result, $expression);
            echo $subExpression . PHP_EOL;
            return $this->calculateExpression($expression, $pattern);
        }

        return $expression;
    }

    private function countIt(string $expression, string $pattern): string
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

    private function calculateTrigonometry(string $expression): string
    {
        $pattern = '/(())(sin|cos|tan)(-?\d+(\.\d+)?)/';
        return $this->calculateExpression($expression, $pattern);
    }

    private function calculateExponentiation(string $expression): string
    {
        $pattern = '/(-?\d+(\.\d+)?)(pow)(-?\d+(\.\d+)?)/';
        return $this->calculateExpression($expression, $pattern);
    }

    private function calculateMultiplyAndDivide(string $expression): string
    {
        $pattern = '/(-?\d+(\.\d+)?)([*\/])(-?\d+(\.\d+)?)/';
        return $this->calculateExpression($expression, $pattern);
    }

    private function calculatePlusAndMinus(string $expression): string
    {
        $pattern = '/(-?\d+(\.\d+)?)([+\-])(-?\d+(\.\d+)?)/';
        return $this->calculateExpression($expression, $pattern);
    }
}