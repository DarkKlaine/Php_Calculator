<?php

namespace Engine\App\Views;

class LoginView
{
    private string $title = 'PHP_Calculator';
    private string $indexTplFile = 'index.tpl.php';
    private string $loginTplFile = 'login.tpl.php';

    public function render(): void
    {
        $templateEngine = new TemplateEngine();

        $templateEngine->assignVar('title', $this->title);

        $templateEngine->setInjectTplFile($this->loginTplFile);

        $templateEngine->display($this->indexTplFile);
    }
}