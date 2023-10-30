<?php
/**
 * uses App/Views/Templates/history.tpl.php
 */

namespace App\Views;

class HistoryView
{
    private string $title = 'PHP_Calculator';
    private string $indexTplFile = 'index.tpl.php';
    private string $historyTplFile = 'history.tpl.php';

    public function render(string $history): void
    {
        $templateEngine = new TemplateEngine();

        $templateEngine->assignVar('title', $this->title);

        $templateEngine->assignVar('history', $history);

        $templateEngine->setInjectTplFile($this->historyTplFile);

        $templateEngine->display($this->indexTplFile);
    }
}
