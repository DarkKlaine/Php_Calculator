<?php

namespace Modules\Calculator\Views;

interface ICalculatorConfigManagerWeb
{
    public function getCalculatorUrl(): string;

    public function getCalculateUrl(): string;

    public function getGlobalHistoryUrl(): string;

    public function getSessionHistoryUrl(): string;
}
