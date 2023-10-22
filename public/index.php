<?php

require_once('../vendor/autoload.php');

do {

    print_r('User input: > ');
    $input = readline();
    if ($input == 'stop') {
        print_r('Stopped. Bye.');
        (new App\PSRLogger())->log(Psr\Log\LogLevel::DEBUG, 'Stopped');
        break;
    }

    $result = (new App\Controller)->countIt($input);
    print_r($result . "\n");

} while (true);