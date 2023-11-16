<?php

namespace Modules\Calculator\Controllers;

interface ICalculatorModel
{
    public function getResult(string $expression): string;
}