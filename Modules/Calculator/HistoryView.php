<?php
/**
 * uses App/Views/Templates/history.tpl.php
 */

namespace Modules\Calculator;

use Engine\Views\TemplateEngine;

class HistoryView
{
    private string $title = 'PHP_Calculator';
    private string $indexTplFile = 'index.tpl.php';
    private string $historyTplFile = 'history.tpl.php';

    public function render(string $history): void
    {
        $templateEngine = new TemplateEngine('../Config/Templates/');

        $templateEngine->assignVar('title', $this->title);

        $templateEngine->assignVar('history', $history);

        $templateEngine->setInjectTplFile($this->historyTplFile);

        $templateEngine->display($this->indexTplFile);
    }
}
