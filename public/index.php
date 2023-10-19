<?php

require_once('../vendor/autoload.php');

do {

print_r('User input: > ');
$input = readline();
if ($input == 'stop') break;

$parsed_input = explode(' ', $input);
$result = App\Controller::countIt($parsed_input[0], $parsed_input[1], $parsed_input[2]);
print_r($result . "\n");

(new App\CalculatorLogger)->doNewLog($input, $result);

} while (true);