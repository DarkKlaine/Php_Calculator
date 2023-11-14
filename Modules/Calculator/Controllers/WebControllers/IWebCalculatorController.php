<?php

namespace Modules\Calculator\Controllers\WebControllers;

use Engine\Router\WebRouter\WebRequestDTO;

interface IWebCalculatorController
{
    public function showForm(WebRequestDTO $request): void;

    public function calculate(WebRequestDTO $request): void;
}