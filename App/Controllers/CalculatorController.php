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
        $logger = new CalculatorLogger();
        if (preg_match($this->inputPattern, $this->input)) {
            $inputData = explode(' ', $this->input);

            if ($inputData[1] == "+") {
                $this->result = (new Addition($inputData[0], $inputData[1], $inputData[2]))->getResult();
            } elseif ($inputData[1] == "-") {
                $this->result = (new Subtraction($inputData[0], $inputData[1], $inputData[2]))->getResult();
            } elseif ($inputData[1] == "*") {
                $this->result = (new Multiply($inputData[0], $inputData[1], $inputData[2]))->getResult();
            } elseif ($inputData[1] == "/") {
                $this->result = (new Divide($inputData[0], $inputData[1], $inputData[2]))->getResult();
            } elseif ($inputData[1] == "pow") {
                $this->result = (new Exponentiation($inputData[0], $inputData[1], $inputData[2]))->getResult();
            } elseif ($inputData[1] == "sin" || $inputData[1] == "cos" || $inputData[1] == "tan") {
                $this->result = (new SinCosTan($inputData[0], $inputData[1]))->getResult();
            } else {
                $this->result = "Error. Incorrect operator.";
                $logger->error('Ошибка. Неправильный математический оператор.');
            }

        } else {
            $this->result = "Error. Wrong input! Try again.";
            $logger->error("Неправильный ввод: $this->input");

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
