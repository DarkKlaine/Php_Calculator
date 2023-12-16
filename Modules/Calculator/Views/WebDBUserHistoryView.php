<?php
/**
 * uses App/Views/Templates/history.tpl.php
 */

namespace Modules\Calculator\Views;

use Engine\Views\IWebTemplateEngine;
use Engine\Views\ViewConst;
use Modules\Calculator\Services\ConfigManager\ICalculatorConfigManagerWeb;

class WebDBUserHistoryView
{
    private string $title = 'История пользователя';
    private string $indexTplFile = 'index.tpl.php';
    private string $menuTplFile = 'menu.tpl.php';
    private string $historyTplFile = 'historyUser.tpl.php';
    private IWebTemplateEngine $templateEngine;
    private ICalculatorConfigManagerWeb $configManager;

    public function __construct(IWebTemplateEngine $templateEngine, ICalculatorConfigManagerWeb $configManager)
    {
        $this->templateEngine = $templateEngine;
        $this->configManager = $configManager;
    }

    public function render(array $history): void
    {
        $this->templateEngine->setModuleTemplatesPath(__DIR__ . '/Templates/');

        $this->templateEngine->assignVar(ViewConst::TITLE, $this->title);

        $this->templateEngine->assignVar('HistoryData', $history);

        $this->templateEngine->assignVar('Calculator', $this->configManager->getCalculatorUrl());
        $this->templateEngine->assignVar('GlobalHistory', $this->configManager->getGlobalHistoryUrl());
        $this->templateEngine->assignVar('SessionHistory', $this->configManager->getSessionHistoryUrl());

        $this->templateEngine->setTemplatesForInjection($this->historyTplFile, $this->menuTplFile);

        $this->templateEngine->display($this->indexTplFile);
    }
}
