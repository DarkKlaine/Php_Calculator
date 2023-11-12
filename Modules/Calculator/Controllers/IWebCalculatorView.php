<?php

namespace Modules\Calculator\Controllers;

interface IWebCalculatorView
{
    public function render(string $input, string $result): void;
}