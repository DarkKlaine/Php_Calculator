<?php

namespace App;

class Run
{
    public function runIndex(): void
    {
        $view = new CalculatorView();
        $controller = new CalculatorController();
        $controller->handleRequest();
        $view->render($controller->getInput(), $controller->getResult());
    }
    public function runHistory(): void
    {
        $view = new CalculatorView();
        $controller = new CalculatorController();
        $view->renderHistory($controller->getHistory());
    }
}
