<?php
/**
 * uses App/Views/Templates/history.tpl.php
 */

namespace Modules\Calculator\Views;

use Engine\Views\IWebTemplateEngine;
use Modules\Calculator\Controllers\WebControllers\IWebHistoryView;
use Modules\Calculator\Services\ConfigManager\ICalculatorConfigManagerWeb;

class WebHistoryView implements IWebHistoryView
{
    private string $title = 'PHP_Calculator';
    private string $indexTplFile = 'index.tpl.php';
    private string $linksTplFile = 'links.tpl.php';
    private string $historyTplFile = 'history.tpl.php';
    private IWebTemplateEngine $templateEngine;
    private ICalculatorConfigManagerWeb $configManager;

    public function __construct(IWebTemplateEngine $templateEngine, ICalculatorConfigManagerWeb $configManager)
    {
        $this->templateEngine = $templateEngine;
        $this->configManager = $configManager;
    }

    public function render(string $history): void
    {
        $this->templateEngine->setModuleTemplatesPath(__DIR__ . '/Templates/');

        $this->templateEngine->assignVar('title', $this->title);

        $this->templateEngine->assignVar('history', $history);

        $this->templateEngine->assignVar('Calculator', $this->configManager->getCalculatorUrl());
        $this->templateEngine->assignVar('GlobalHistory', $this->configManager->getGlobalHistoryUrl());
        $this->templateEngine->assignVar('SessionHistory', $this->configManager->getSessionHistoryUrl());
        $this->templateEngine->assignVar('DataBaseHistory', $this->configManager->getDataBaseHistoryUrl());

        $this->templateEngine->setInjectTplFile($this->linksTplFile, $this->historyTplFile, null,);

        $this->templateEngine->display($this->indexTplFile);
    }
}
