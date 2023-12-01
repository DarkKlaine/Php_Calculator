<?php

namespace Modules\User\Views;

use Engine\Views\IWebTemplateEngine;
use Modules\User\IUserConfigManagerWeb;

class UserSetPasswordView
{
    private string $title = 'Придумайте пароль';
    private string $description = 'Может состоять из 2–12 букв или цифр';
    private string $indexTplFile = 'index.tpl.php';
    private string $contentTplFile = 'setPassword.tpl.php';
    private string $pswScriptTplFile = 'psw.script.tpl.php';
    private IWebTemplateEngine $templateEngine;
    private IUserConfigManagerWeb $configManager;

    public function __construct(IWebTemplateEngine $templateEngine, IUserConfigManagerWeb $configManager)
    {
        $this->templateEngine = $templateEngine;
        $this->configManager = $configManager;
    }

    public function render(): void
    {
        $this->templateEngine->assignVar('Title', $this->title);
        $this->templateEngine->assignVar('Description', $this->description);

        $this->templateEngine->setModuleTemplatesPath(__DIR__ . '/Templates/');

        $this->templateEngine->assignVar('Action', $this->configManager->getSetRoleUrl());

        $this->templateEngine->setTemplatesForInjection($this->contentTplFile, scriptTpl: $this->pswScriptTplFile);

        $this->templateEngine->display($this->indexTplFile);
    }
}
