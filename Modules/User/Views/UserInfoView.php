<?php

namespace Modules\User\Views;

use Engine\Views\IWebTemplateEngine;
use Engine\Views\ViewConst;
use Modules\User\Controllers\UserConst;
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
        $this->templateEngine->assignVar(ViewConst::TITLE, $this->title);

        $this->templateEngine->assignVar(UserConst::USERNAME, $userData[UserConst::USERNAME]);
        $this->templateEngine->assignVar(UserConst::ROLE, $userData[UserConst::ROLE]);
        $this->templateEngine->assignVar(UserConst::DATE, $userData[UserConst::DATE]);

        $this->templateEngine->assignVar('SetUsername', $this->configManager->getSetUsernameUrl());
        $this->templateEngine->assignVar('ShowUsersList', $this->configManager->getShowUserListUrl());

        $this->templateEngine->setModuleTemplatesPath(__DIR__ . '/Templates/');
        $this->templateEngine->setTemplatesForInjection($this->contentTplFile);
        $this->templateEngine->display($this->indexTplFile);
    }
}
