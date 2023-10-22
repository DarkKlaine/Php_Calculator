<?php

namespace App;
class Controller
{
    static public function countIt($input): string|float
    {
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

        (new CalculatorLogger)->addToLog($input, $result);

        return $result;
    }
}