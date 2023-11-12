<?php

namespace Modules\Calculator\Controllers;

interface ICalculatorModel
{
    public function countIt(array $inputData): string;
}