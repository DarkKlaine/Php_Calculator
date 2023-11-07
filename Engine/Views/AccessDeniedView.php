<?php

namespace Engine\Views;

use Engine\Container\Container;
use Engine\Controllers\IAccessDeniedView;

class AccessDeniedView implements IAccessDeniedView
{
    private string $title = 'PHP_Calculator';
    private string $indexTplFile = 'index.tpl.php';
    private string $accessDeniedTplFile = 'accessDenied.tpl.php';
    private ITemplateEngine $templateEngine;

    public function __construct(Container $container)
    {
        $this->templateEngine = $container->get(ITemplateEngine::class);
    }

    public function render(): void
    {
        $this->templateEngine->setModuleTemplatesPath('../Config/Templates/');

        $this->templateEngine->assignVar('title', $this->title);

        $this->templateEngine->setInjectTplFile($this->accessDeniedTplFile);

        $this->templateEngine->display($this->indexTplFile);
    }
}