<?php

namespace Modules\Calculator\Controllers;

use Engine\DTO\Request;

interface ICalculatorController
{
    public function showForm(Request $request): void;

    public function calculate(Request $request): void;
}