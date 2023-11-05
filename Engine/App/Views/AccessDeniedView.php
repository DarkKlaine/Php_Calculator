<?php

namespace Engine\App\Views;

class AccessDeniedView
{
    private string $title = 'PHP_Calculator';
    private string $indexTplFile = 'index.tpl.php';
    private string $accessDeniedTplFile = 'accessDenied.tpl.php';

    public function render(): void
    {
        $templateEngine = new TemplateEngine();

        $templateEngine->assignVar('title', $this->title);

        $templateEngine->setInjectTplFile($this->accessDeniedTplFile);

        $templateEngine->display($this->indexTplFile);
    }
}