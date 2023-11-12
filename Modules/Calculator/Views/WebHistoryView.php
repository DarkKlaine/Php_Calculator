<?php
/**
 * uses App/Views/Templates/history.tpl.php
 */

namespace Modules\Calculator\Views;

use Engine\Views\IWebTemplateEngine;
use Modules\Calculator\Controllers\IWebHistoryView;

class WebHistoryView implements IWebHistoryView
{
    private string $title = 'PHP_Calculator';
    private string $indexTplFile = 'index.tpl.php';
    private string $historyTplFile = 'history.tpl.php';
    private IWebTemplateEngine $templateEngine;

    public function __construct(IWebTemplateEngine $templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }

    public function render(string $history): void
    {
        $this->templateEngine->setModuleTemplatesPath(__DIR__ . '/Templates/');

        $this->templateEngine->assignVar('title', $this->title);

        $this->templateEngine->assignVar('history', $history);

        $this->templateEngine->setInjectTplFile($this->historyTplFile);

        $this->templateEngine->display($this->indexTplFile);
    }
}
