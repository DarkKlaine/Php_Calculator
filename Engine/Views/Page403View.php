<?php

namespace Engine\Views;

class Page403View
{
    private string $indexTplFile = 'index.tpl.php';
    private string $pageTplFile = '403.tpl.php';
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
