<?php

namespace App;

use Psr\Log\LogLevel;

class CalculatorController
{

    private string $input = '';
    private string $result = '';

    private string $history = '';
    private string $inputPattern = '/\d+(\.?\d+)? (([+\-\/*]|pow) \d+(\.?\d+)?|sin|cos|tan)/';

    public function handleRequest(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->input = $_POST['userInput'];
            $this->countIt();
        }
    }

    private function countIt(): void
    {
        if (preg_match($this->inputPattern, $this->input)) {
            $inputData = explode(' ', $this->input);

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

        (new HistoryMaker())->addToHistory($this->input, $this->result);

    }

    protected function createHistoryString():void
    {
        $logArray = file('../log/History.log');
        for ($i = 0; $i < count($logArray); $i++) {
            $this->history .= str_replace(' ', '&nbsp', $logArray[$i]);
        }
    }

    public function getInput(): string
    {
        return $this->input;
    }

    public function getResult(): string
    {
        return $this->result;
    }

    public function getHistory(): string
    {
        $this->createHistoryString();
        return $this->history;
    }
}
