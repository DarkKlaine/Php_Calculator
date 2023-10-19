<?php
require_once('../app/Controller.php');
require_once('../app/Computations.php');
require_once('../app/Addition.php');
require_once('../app/Subtraction.php');
require_once('../app/Multiply.php');
require_once('../app/Divide.php');

//$input = readline();
$input = ["5", "*", "10"];

$result = Controller::countIt($input[0], $input[1], $input[2]);
print_r($result);