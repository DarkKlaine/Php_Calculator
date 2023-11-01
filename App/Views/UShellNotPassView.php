<?php

namespace App\Views;

class UShellNotPassView
{
    private string $title = 'PHP_Calculator';
    private string $indexTplFile = 'index.tpl.php';
    private string $ushellnotpassTplFile = 'ushellnotpass.tpl.php';

    public function render(): void
    {
        $templateEngine = new TemplateEngine();

        $templateEngine->assignVar('title', $this->title);

        $templateEngine->setInjectTplFile($this->ushellnotpassTplFile);

        $templateEngine->display($this->indexTplFile);
    }
}