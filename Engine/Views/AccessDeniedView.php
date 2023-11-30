<?php

namespace Engine\Views;

use Engine\Controllers\IAccessDeniedView;

class AccessDeniedView implements IAccessDeniedView
{
    private string $title = 'PHP_Calculator';
    private string $indexTplFile = 'index.tpl.php';
    private string $accessDeniedTplFile = 'accessDenied.tpl.php';
    private IWebTemplateEngine $templateEngine;

    public function __construct(IWebTemplateEngine $templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }

    public function render(): void
    {
        $this->templateEngine->assignVar('title', $this->title);

        $this->templateEngine->setTemplatesForInjection($this->accessDeniedTplFile);

        $this->templateEngine->display($this->indexTplFile);
    }
}