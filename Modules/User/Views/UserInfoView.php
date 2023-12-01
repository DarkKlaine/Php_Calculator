<?php

namespace Modules\User\Views;

use Engine\Views\IWebTemplateEngine;
use Modules\User\IUserConfigManagerWeb;

class UserInfoView
{
    private string $title = 'Иформация о пользователе';
    private string $username = 'DarkKlaine';
    private string $role = 'Администратор';
    private string $registerDate = '01.12.2023 22:22';

    private string $indexTplFile = 'index.tpl.php';
    private string $contentTplFile = 'userInfo.tpl.php';
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
        $this->templateEngine->assignVar('Username', $this->username);
        $this->templateEngine->assignVar('Role', $this->role);
        $this->templateEngine->assignVar('RegisterDate', $this->registerDate);

        $this->templateEngine->setModuleTemplatesPath(__DIR__ . '/Templates/');

        $this->templateEngine->assignVar('Action', $this->configManager->getSetUsernameUrl());
        $this->templateEngine->assignVar('ShowUsersList', $this->configManager->getShowUserListUrl());

        $this->templateEngine->setTemplatesForInjection($this->contentTplFile);

        $this->templateEngine->display($this->indexTplFile);
    }
}
