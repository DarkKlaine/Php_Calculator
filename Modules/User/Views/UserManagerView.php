<?php

namespace Modules\User\Views;

use Engine\Views\IWebTemplateEngine;

class UserManagerView
{
    private string $title = 'Панель управления<br>пользователями';
    private string $indexTplFile = 'index.tpl.php';
    private string $moduleTemplatesPath = __DIR__ . '/Templates/';
    private string $contentTplFile = 'userManager.tpl.php';
    private IWebTemplateEngine $templateEngine;

    public function __construct(IWebTemplateEngine $templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }

    public function render(): void
    {
        $this->templateEngine->assignVar('Title', $this->title);

        $this->templateEngine->setModuleTemplatesPath($this->moduleTemplatesPath);

        $this->templateEngine->setTemplatesForInjection($this->contentTplFile);

        $this->templateEngine->display($this->indexTplFile);
    }
}
