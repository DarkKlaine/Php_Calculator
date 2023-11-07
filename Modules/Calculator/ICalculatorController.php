<?php

namespace Modules\Calculator;

use Engine\DTO\Request;

interface ICalculatorController
{
    public function showForm(Request $request): void;

    public function calculate(Request $request): void;
}