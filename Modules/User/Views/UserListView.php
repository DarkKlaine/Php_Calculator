<?php

namespace Modules\User\Views;

use Engine\Views\IWebTemplateEngine;
use Engine\Views\ViewConst;
use Modules\User\Controllers\UserConst;
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
        $this->templateEngine->assignVar(ViewConst::TITLE, $this->title);

        $this->templateEngine->setModuleTemplatesPath(__DIR__ . '/Templates/');

        $this->templateEngine->assignVar('UsersData', $usersData);

        $this->templateEngine->assignVar('ShowUserInfo', $this->configManager->getShowUserInfoUrl());
        $this->templateEngine->assignVar('SetUsername', $this->configManager->getSetUsernameUrl());
        $this->templateEngine->assignVar('DeleteUser', $this->configManager->getDeleteUserUrl());

        $this->templateEngine->setTemplatesForInjection($this->contentTplFile);

        $this->templateEngine->display($this->indexTplFile);
    }
}
