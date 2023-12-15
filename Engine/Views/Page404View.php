<?php

namespace Engine\Views;

class Page404View
{
    private string $indexTplFile = 'index.tpl.php';
    private string $pageTplFile = '404.tpl.php';
    private IWebTemplateEngine $templateEngine;

    public function __construct(IWebTemplateEngine $templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }

    public function render(): void
    {
        $this->templateEngine->setTemplatesForInjection($this->pageTplFile);
        $this->templateEngine->display($this->indexTplFile);
    }
}
