<?php

namespace Modules\User\Views;

use Engine\Services\Routers\WebRouter\WebRequestDTO;
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

    public function render(WebRequestDTO $request, string $operation, string $passwordHash): void
    {
        $username = $request->getPost()['username'] ?? null;

        $this->templateEngine->assignVar('Title', $this->title);
        $this->templateEngine->assignVar('Description', $this->description);

        $this->templateEngine->assignVar('Action', $this->configManager->getRecordUserDataUrl());
        $this->templateEngine->assignVar('Operation', $operation);
        $this->templateEngine->assignVar('CurrentUsername', $request->getPost()['currentUsername'] ?? '');
        $this->templateEngine->assignVar('Username', $username);
        $this->templateEngine->assignVar('Password', $passwordHash);

        $this->templateEngine->setModuleTemplatesPath(__DIR__ . '/Templates/');
        $this->templateEngine->setTemplatesForInjection($this->contentTplFile);
        $this->templateEngine->display($this->indexTplFile);
    }
}
