<?php

namespace Modules\Calculator\Services\ConfigManager;

use Engine\Services\ConfigManagers\BaseConfigManagerWeb;

class CalculatorConfigManagerWeb extends BaseConfigManagerWeb implements ICalculatorConfigManagerWeb
{

    public function __construct(array $appConfig)
    {
        parent::__construct($appConfig);
    }

    public function getCalculatorUrl(): string {
        return $this->routes['Calculator']['url'];
    }

    public function getCalculateUrl(): string {
        return $this->routes['Calculate']['url'];
    }

    public function getGlobalHistoryUrl(): string {
        return $this->routes['GlobalHistory']['url'];
    }

    public function getSessionHistoryUrl(): string {
        return $this->routes['SessionHistory']['url'];
    }

    public function getDataBaseHistoryUrl(): string {
        return $this->routes['DataBaseHistory']['url'];
    }
}