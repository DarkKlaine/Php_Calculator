<?php

class Controller
{
    static public function countIt($arg1, $arg2, $arg3): string|float
    {
        switch ($arg2) {
            case "+":
                $answer = new Addition($arg1, $arg2, $arg3);
                return $answer->getResult();
            case "-":
                $answer = new Subtraction($arg1, $arg2, $arg3);
                return $answer->getResult();
            case "*":
                $answer = new Multiply($arg1, $arg2, $arg3);
                return $answer->getResult();
            case "/":
                $answer = new Divide($arg1, $arg2, $arg3);
                return $answer->getResult();
            default:
                return "Eror. Incorrect math.";
        }
    }
}