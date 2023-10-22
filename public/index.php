<?php

require_once('../vendor/autoload.php');

do {

    print_r('User input: > ');
    $input = readline();
    if ($input == 'stop') {
        print_r("Stopped. Bye.");
        break;
    }
    if (!preg_match('/\d+(\.?\d+)? [+\-\/*] \d+(\.?\d+)?/', $input)) {
        print_r("Error. Wrong input! Try again.\n");
    } else {
        $parsed_input = explode(' ', $input);
        $result = App\Controller::countIt($parsed_input[0], $parsed_input[1], $parsed_input[2]);
        print_r($result . "\n");

        (new App\CalculatorLogger)->addToLog($input, $result);
    }
} while (true);