<?php

use App\CalculatorController;
use App\CalculatorView;


require_once('../vendor/autoload.php');

$view = new CalculatorView();
$controller = new CalculatorController();

$controller->handleRequest();

$view->render($controller->inputString, $controller->result);

