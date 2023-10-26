<?php

namespace App\Controllers;

use App\Models\Computations\Addition;
use App\Models\Computations\Divide;
use App\Models\Computations\Exponentiation;
use App\Models\Computations\Multiply;
use App\Models\Computations\SinCosTan;
use App\Models\Computations\Subtraction;
use App\Models\Logger\CalculatorLogger;
use App\Models\Logger\HistoryMaker;

class CalculatorController
{

    private string $input = '';
    private string $result = '';

    private string $inputPattern = '/\d+(\.?\d+)? (([+\-\/*]|pow) \d+(\.?\d+)?|sin|cos|tan)/';

    public function handleRequest(): void
    {
        //var_dump($_SERVER);
        //die;
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

    public function getResult(): string
    {
        return $this->result;
    }

    public function getInput(): string
    {
        return $this->input;
    }

    public function getHistory(): string
    {
        return (new HistoryMaker())->createHistoryString();
    }
}
