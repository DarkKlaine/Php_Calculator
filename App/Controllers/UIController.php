<?php

namespace App\Controllers;

use App\DTO\Request;
use App\Views\CalculatorView;

class UIController extends BaseController
{

    public function run(Request $request, ?string $parameter = NULL): void
    {
        $get = $request->getGet();

        $input = $get['input'] ?? '';
        $result = $get['result'] ?? '';

        $view = new CalculatorView();
        $view->render($input, $result);
    }
}




