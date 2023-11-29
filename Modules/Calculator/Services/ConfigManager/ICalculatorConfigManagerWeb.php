<?php

namespace Modules\Calculator\Services\ConfigManager;

interface ICalculatorConfigManagerWeb
{
    public function getCalculatorUrl(): string;

    public function getCalculateUrl(): string;

    public function getGlobalHistoryUrl(): string;

    public function getSessionHistoryUrl(): string;

    public function getDataBaseHistoryUrl(): string;
}