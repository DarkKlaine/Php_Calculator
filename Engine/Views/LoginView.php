<?php

namespace Engine\Views;

use Engine\Controllers\ILoginView;

class LoginView implements ILoginView
{
    private string $title = 'PHP_Calculator';
    private string $indexTplFile = 'index.tpl.php';
    private string $loginTplFile = 'login.tpl.php';
    private IWebTemplateEngine $templateEngine;

    public function __construct(IWebTemplateEngine $templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }

    public function render(): void
    {
        $this->templateEngine->assignVar('title', $this->title);

        $this->templateEngine->setInjectTplFile($this->loginTplFile);

        $this->templateEngine->display($this->indexTplFile);
    }
}