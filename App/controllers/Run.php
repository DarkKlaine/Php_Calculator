<?php

namespace App;

class Run
{
    public function __construct()
    {
        $view = new CalculatorView();
        $controller = new CalculatorController();
        $controller->handleRequest();
        $view->render($controller->getInput(), $controller->getResult());
    }
}
