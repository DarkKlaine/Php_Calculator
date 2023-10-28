<?php

namespace App\Controllers;

use App\Views\CalculatorView;

class UIController extends BaseController
{

    public function run(object $serverGlobalDTO): void
    {
        $post = $serverGlobalDTO->getGet();

        $input = $post['input'] ?? '';
        $result = $post['result'] ?? '';

        $view = new CalculatorView();
        $view->render($input, $result);
    }
}




