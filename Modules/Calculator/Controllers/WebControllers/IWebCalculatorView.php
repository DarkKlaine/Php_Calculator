<?php

namespace Modules\Calculator\Controllers\WebControllers;

interface IWebCalculatorView
{
    public function render(string $input, string $result): void;
}