<?php

namespace App\Controllers;

use App\Views\CalculatorView;

class UIController extends BaseController
{

    public function run(object $serverGlobalDTO): void
    {
        $get = $serverGlobalDTO->getGet();

        $input = $get['input'] ?? '';
        $result = $get['result'] ?? '';

        $view = new CalculatorView();
        $view->render($input, $result);
    }
}




