<?php

namespace Modules\Calculator\Views;

use Engine\Views\IWebTemplateEngine;
use Modules\Calculator\Controllers\WebControllers\IWebCalculatorView;
use Modules\Calculator\Services\ConfigManager\ICalculatorConfigManagerWeb;

class WebCalculatorView implements IWebCalculatorView
{
    private string $title = 'PHP_Calculator';
    private string $indexTplFile = 'index.tpl.php';
    private string $menuTplFile = 'menu.tpl.php';
    private string $calculatorTplFile = 'calculator.tpl.php';

    private IWebTemplateEngine $templateEngine;
    private ICalculatorConfigManagerWeb $configManager;

    public function __construct(IWebTemplateEngine $templateEngine, ICalculatorConfigManagerWeb $configManager)
    {
        $this->templateEngine = $templateEngine;
        $this->configManager = $configManager;
    }
    public function render(string $input, string $result): void
    {
        $this->templateEngine->setModuleTemplatesPath(__DIR__ . '/Templates/');

        $this->templateEngine->assignVar('title', $this->title);

        $this->templateEngine->assignVar('input', $input);

        $this->templateEngine->assignVar('result', $result);

        $this->templateEngine->assignVar('Calculator', $this->configManager->getCalculatorUrl());
        $this->templateEngine->assignVar('Calculate', $this->configManager->getCalculateUrl());
        $this->templateEngine->assignVar('GlobalHistory', $this->configManager->getGlobalHistoryUrl());
        $this->templateEngine->assignVar('SessionHistory', $this->configManager->getSessionHistoryUrl());
        $this->templateEngine->assignVar('DataBaseHistory', $this->configManager->getDataBaseHistoryUrl());

        $this->templateEngine->setTemplatesForInjection($this->calculatorTplFile, $this->menuTplFile);

        $this->templateEngine->display($this->indexTplFile);
    }
}
