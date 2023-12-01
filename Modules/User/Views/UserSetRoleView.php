<?php

namespace Modules\User\Views;

use Engine\Views\IWebTemplateEngine;
use Modules\User\IUserConfigManagerWeb;

class UserSetRoleView
{
    private string $title = 'Выберите роль';
    private string $description = 'Может состоять из 2–12 букв или цифр';
    private string $indexTplFile = 'index.tpl.php';
    private string $contentTplFile = 'setRole.tpl.php';
    private IWebTemplateEngine $templateEngine;
    private IUserConfigManagerWeb $configManager;

    public function __construct(IWebTemplateEngine $templateEngine, IUserConfigManagerWeb $configManager)
    {
        $this->templateEngine = $templateEngine;
        $this->configManager = $configManager;
    }

    public function render($request): void
    {
        $this->templateEngine->assignVar('Title', $this->title);
        $this->templateEngine->assignVar('Description', $this->description);

        $this->templateEngine->setModuleTemplatesPath(__DIR__ . '/Templates/');

        $this->templateEngine->assignVar('Action', $this->configManager->getShowUserInfoUrl());

        $username = $request->getPost()['username'] ?? null;
        $this->templateEngine->assignVar('Username', $username);

        $password = $request->getPost()['password'] ?? null;
        $this->templateEngine->assignVar('Password', $password);

        $this->templateEngine->setTemplatesForInjection($this->contentTplFile);

        $this->templateEngine->display($this->indexTplFile);
    }
}
