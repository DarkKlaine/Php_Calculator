<?php

require_once('../vendor/autoload.php');

do {

    print_r('User input: > ');
    $input = readline();
    if ($input == 'stop') {
        print_r("Stopped. Bye.");
        break;
    }

    $pattern = '/\d+(\.?\d+)? (([+\-\/*]|pow) \d+(\.?\d+)?|sin|cos|tan)/';
    if (!preg_match($pattern, $input)) {
        print_r("Error. Wrong input! Try again.\n");
    } else {
        $result = App\Controller::countIt($input);
        print_r($result . "\n");
    }

} while (true);