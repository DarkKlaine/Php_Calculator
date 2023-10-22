<?php

namespace App;

class Controller
{
    protected string $inputPattern = '/\d+(\.?\d+)? (([+\-\/*]|pow) \d+(\.?\d+)?|sin|cos|tan)/';

    public function countIt(string $input): string|float
    {
        if (!preg_match($this->inputPattern, $input)) {
            $result = "Error. Wrong input! Try again.";
        } else {
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

        }

        (new CalculatorLogger)->addToLog($input, $result);

        return $result;
    }
}