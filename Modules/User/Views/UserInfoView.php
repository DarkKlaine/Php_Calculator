<?php

namespace Modules\User\Views;

use Engine\Views\IWebTemplateEngine;
use Modules\User\IUserConfigManagerWeb;

class UserInfoView
{
    private string $title = 'Иформация о пользователе';
    private string $indexTplFile = 'index.tpl.php';
    private string $contentTplFile = 'userInfo.tpl.php';
    private IWebTemplateEngine $templateEngine;
    private IUserConfigManagerWeb $configManager;

    public function __construct(IWebTemplateEngine $templateEngine, IUserConfigManagerWeb $configManager)
    {
        $this->templateEngine = $templateEngine;
        $this->configManager = $configManager;
    }

    public function render(array $userData): void
    {
        $this->templateEngine->assignVar('Title', $this->title);

        $this->templateEngine->assignVar('Username', $userData['username']);
        $this->templateEngine->assignVar('Role', $userData['role']);
        $this->templateEngine->assignVar('Date', $userData['date']);

        $this->templateEngine->assignVar('EditUser', $this->configManager->getSetUsernameUrl());
        $this->templateEngine->assignVar('ShowUsersList', $this->configManager->getShowUserListUrl());

        $this->templateEngine->setModuleTemplatesPath(__DIR__ . '/Templates/');
        $this->templateEngine->setTemplatesForInjection($this->contentTplFile);
        $this->templateEngine->display($this->indexTplFile);
    }
}
