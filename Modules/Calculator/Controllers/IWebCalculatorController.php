<?php

namespace Modules\Calculator\Controllers;

use Engine\DTO\WebRequestDTO;

interface IWebCalculatorController
{
    public function showForm(WebRequestDTO $request): void;

    public function calculate(WebRequestDTO $request): void;
}