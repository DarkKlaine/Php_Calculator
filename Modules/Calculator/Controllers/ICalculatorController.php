<?php

namespace Modules\Calculator\Controllers;

use Engine\DTO\WebRequestDTO;

interface ICalculatorController
{
    public function showForm(WebRequestDTO $request): void;

    public function calculate(WebRequestDTO $request): void;
}