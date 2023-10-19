<?php

use App\Controller;

require_once('../vendor/autoload.php');

//$input = readline();
$input = ["5", "*", "10"];

$result = Controller::countIt($input[0], $input[1], $input[2]);
print_r($result);