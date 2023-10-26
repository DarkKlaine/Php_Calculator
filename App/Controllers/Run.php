<?php

//TODO Исправить обработку отрицательных значений ввода
//TODO Исправить вывод если ответ НОЛЬ
//TODO Apache redirect в index.php
//TODO сделать BaseController и от него сделать 2 наследника CalculatorController и HistoryController
//TODO В роутере в зависимости от адреса обращения запускать какой-то из них методом Run

namespace App\Controllers;

use App\Views\CalculatorView;

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
