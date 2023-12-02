<?php

namespace Modules\User\Views;

use Engine\Views\IWebTemplateEngine;
use Modules\User\IUserConfigManagerWeb;

class UserListView
{
    private string $title = 'Список пользователей';
    private string $indexTplFile = 'index.tpl.php';
    private string $contentTplFile = 'userList.tpl.php';
    private IWebTemplateEngine $templateEngine;
    private IUserConfigManagerWeb $configManager;

    public function __construct(IWebTemplateEngine $templateEngine, IUserConfigManagerWeb $configManager)
    {
        $this->templateEngine = $templateEngine;
        $this->configManager = $configManager;
    }

    public function render(array $usersData): void
    {
        $this->templateEngine->assignVar('Title', $this->title);

        $this->templateEngine->setModuleTemplatesPath(__DIR__ . '/Templates/');

        $this->templateEngine->assignVar('UsersData', $usersData);

        $this->templateEngine->assignVar('Info', $this->configManager->getShowUserInfoUrl());
        $this->templateEngine->assignVar('Edit', $this->configManager->getSetUsernameUrl());
        $this->templateEngine->assignVar('Delete', $this->configManager->getShowUserListUrl());

        $this->templateEngine->setTemplatesForInjection($this->contentTplFile);

        $this->templateEngine->display($this->indexTplFile);
    }
}
