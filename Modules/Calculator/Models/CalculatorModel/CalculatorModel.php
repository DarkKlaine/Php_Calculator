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

    public function countIt(array $inputData): string
    {
        // Проверка валидности входных данных
        if ($this->isValidInput($inputData) === false) {
            $message = "Неправильный ввод, попробуйте снова";
            $this->logger->error($message);
            return $message;
        }

        // Безопасно разбираю входные данные на переменные
        $value1 = $inputData[0] ?? '';
        $operator = $inputData[1] ?? '';
        $value2 = $inputData[2] ?? '';

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

    private function isValidInput(array $inputData): bool
    {
        $patternValues = '/^-?\d+(\.\d+)?$/';
        $patternOperators = '/^(?:[+\-\/*]|pow|sin|cos|tan)$/';

        // Проверка на количество аргументов в массиве
        if (count($inputData) < 2) {
            return false;
        }

        // Проверка первого элемента массива
        if (preg_match($patternValues, $inputData[0]) === 0) {
            return false;
        }

        // Проверка второго элемента массива
        if (preg_match($patternOperators, $inputData[1]) === 0) {
            return false;
        }

        // Если второй элемент равен 'sin', 'cos' или 'tan', то третий элемент игнорирую - возвращаю true
        if (in_array($inputData[1], ['sin', 'cos', 'tan'])) {
            return true;
        }

        // Проверка третьего элемента массива
        if (preg_match($patternValues, $inputData[2]) === 0) {
            return false;
        }

        // Если все проверки пройдены - возвращаю true
        return true;
    }
}