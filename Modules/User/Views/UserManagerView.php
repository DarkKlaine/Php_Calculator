<?php

namespace Modules\User\Views;

use Engine\Views\IWebTemplateEngine;
use Modules\User\IUserConfigManagerWeb;

class UserManagerView
{
    private string $title = 'Панель управления<br>пользователями';
    private string $indexTplFile = 'index.tpl.php';
    private string $moduleTemplatesPath = __DIR__ . '/Templates/';
    private string $contentTplFile = 'userManager.tpl.php';
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
        $this->templateEngine->assignVar('CreateUser', $this->configManager->getSetUsernameUrl());
        $this->templateEngine->assignVar('ShowUsersList', $this->configManager->getShowUserListUrl());

        $this->templateEngine->setModuleTemplatesPath($this->moduleTemplatesPath);

        $this->templateEngine->setTemplatesForInjection($this->contentTplFile);

        $this->templateEngine->display($this->indexTplFile);
    }
}
