<?php

namespace App;
class Controller
{
    static public function countIt($value1, $operation, $value2): string|float
    {
        switch ($operation) {
            case "+":
                $answer = new Addition($value1, $operation, $value2);
                return $answer->getResult();
            case "-":
                $answer = new Subtraction($value1, $operation, $value2);
                return $answer->getResult();
            case "*":
                $answer = new Multiply($value1, $operation, $value2);
                return $answer->getResult();
            case "/":
                $answer = new Divide($value1, $operation, $value2);
                return $answer->getResult();
            default:
                return "Error. Incorrect math.";
        }
    }
}