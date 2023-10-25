<?php

namespace App;

use Psr\Log\LogLevel;

class CalculatorController
{

    public string $inputString = '';
    public string $result = '';
    protected string $inputPattern = '/\d+(\.?\d+)? (([+\-\/*]|pow) \d+(\.?\d+)?|sin|cos|tan)/';

    public function handleRequest(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->inputString = $_POST['userInput'];
            $this->countIt();
        }
    }

    private function countIt(): void
    {
        if (preg_match($this->inputPattern, $this->inputString)) {
            $inputData = explode(' ', $this->inputString);

            $this->result = match ($inputData[1]) {
                "+" => (new Addition($inputData[0], $inputData[1], $inputData[2]))->getResult(),
                "-" => (new Subtraction($inputData[0], $inputData[1], $inputData[2]))->getResult(),
                "*" => (new Multiply($inputData[0], $inputData[1], $inputData[2]))->getResult(),
                "/" => (new Divide($inputData[0], $inputData[1], $inputData[2]))->getResult(),
                "pow" => (new Exponentiation($inputData[0], $inputData[1], $inputData[2]))->getResult(),
                "sin", "cos", "tan" => (new SinCosTan($inputData[0], $inputData[1]))->getResult(),
                default => "Error. Incorrect operator.",
            };

        } else {
            $this->result = "Error. Wrong input! Try again.";
        }

        (new PSRLogger())->log(LogLevel::INFO ,'', [$this->inputString, $this->result]);

    }
}

