<?php

namespace Modules\Calculator\Services\ConfigManager;

use Engine\Services\ConfigManagers\BaseConfigManagerWeb;

class CalculatorConfigManagerWeb extends BaseConfigManagerWeb implements ICalculatorConfigManagerWeb
{
    private string $calculatorSublink;

    public function __construct(array $appConfig, array $calculatorConfig)
    {
        parent::__construct($appConfig);
        $this->calculatorSublink = $calculatorConfig['sublink'] ?? '';
    }

    public function getCalculatorSublink(): string
    {
        return $this->calculatorSublink;
    }

    public function getCalculatorUrl(): string {
        return $this->calculatorSublink . $this->routes['Calculator']['url'];
    }

    public function getCalculateUrl(): string {
        return $this->calculatorSublink . $this->routes['Calculate']['url'];
    }

    public function getGlobalHistoryUrl(): string {
        return $this->calculatorSublink . $this->routes['GlobalHistory']['url'];
    }

    public function getSessionHistoryUrl(): string {
        return $this->calculatorSublink . $this->routes['SessionHistory']['url'];
    }

    public function getDataBaseHistoryUrl(): string {
        return $this->calculatorSublink . $this->routes['DataBaseHistory']['url'];
    }
}