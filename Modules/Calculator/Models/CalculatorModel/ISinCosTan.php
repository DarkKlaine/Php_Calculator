<?php

namespace Modules\Calculator\Models\CalculatorModel;

interface ISinCosTan
{
    public function getResult(string $value1, string $action, string $value2 = ''): string;
}