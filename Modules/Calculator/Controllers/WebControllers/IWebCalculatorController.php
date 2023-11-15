<?php

namespace Modules\Calculator\Controllers\WebControllers;

use Engine\Services\Routers\WebRouter\WebRequestDTO;

interface IWebCalculatorController
{
    public function showForm(WebRequestDTO $request): void;

    public function calculate(WebRequestDTO $request): void;
}