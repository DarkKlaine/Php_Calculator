<?php
/**
 * uses App/Views/Templates/history.tpl.php
 */

namespace Modules\Calculator;

use Engine\Container\Container;
use Engine\Views\ITemplateEngine;

class HistoryView implements IHistoryView
{
    private string $title = 'PHP_Calculator';
    private string $indexTplFile = 'index.tpl.php';
    private string $historyTplFile = 'history.tpl.php';
    private ITemplateEngine $templateEngine;

    public function __construct(Container $container)
    {
        $this->templateEngine = $container->get(ITemplateEngine::class);
    }

    public function render($history): void
    {
        $this->templateEngine->setModuleTemplatesPath('../Config/Templates/');

        $this->templateEngine->assignVar('title', $this->title);

        $this->templateEngine->assignVar('history', $history);

        $this->templateEngine->setInjectTplFile($this->historyTplFile);

        $this->templateEngine->display($this->indexTplFile);
    }
}
