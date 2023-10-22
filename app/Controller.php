<?php

namespace App;

use Psr\Log\LogLevel;

class Controller
{
    protected string $inputPattern = '/\d+(\.?\d+)? (([+\-\/*]|pow) \d+(\.?\d+)?|sin|cos|tan)/';

    public function countIt(string $input): string|float
    {
        if (preg_match($this->inputPattern, $input)) {
            $inputData = explode(' ', $input);

            $result = match ($inputData[1]) {
                "+" => (new Addition($inputData[0], $inputData[1], $inputData[2]))->getResult(),
                "-" => (new Subtraction($inputData[0], $inputData[1], $inputData[2]))->getResult(),
                "*" => (new Multiply($inputData[0], $inputData[1], $inputData[2]))->getResult(),
                "/" => (new Divide($inputData[0], $inputData[1], $inputData[2]))->getResult(),
                "pow" => (new Exponentiation($inputData[0], $inputData[1], $inputData[2]))->getResult(),
                "sin", "cos", "tan" => (new SinCosTan($inputData[0], $inputData[1]))->getResult(),
                default => "Error. Incorrect operator.",
            };

        } else {
            $result = "Error. Wrong input! Try again.";
        }

        if (str_contains($result, 'Error')) {
            $level = LogLevel::ERROR;
        } elseif (str_contains($result, 'Warning')) {
            $level = LogLevel::WARNING;
        } else {
            $level = LogLevel::INFO;
        }

        $input = str_contains($result, 'Error') ? "Input: {$input}. " : $input . ' = ';

        (new PSRLogger())->log($level, $input . $result);

        (new CalculatorLogger)->addToLog($input, $result);

        return $result;
    }
}