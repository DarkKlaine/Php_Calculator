<?php

namespace App\Controllers;

use App\DTO\Request;
use App\Models\Logger\HistoryMaker;
use App\Views\HistoryView;

class GeneralHistoryController extends BaseController
{
    private array $parameters;

    public function __construct()
    {
        $historyMaker = new HistoryMaker();
        $this->parameters = [
            'general' => $historyMaker->getGeneralHistoryString(),
            'session' => $historyMaker->getSessionHistoryString(),
        ];
    }
    public function run(Request $request, ?string $parameter = NULL): void
    {
        $view = new HistoryView();
        $view->render($this->parameters[$parameter]);
    }

}