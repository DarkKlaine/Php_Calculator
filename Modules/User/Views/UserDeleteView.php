<?php

namespace Modules\User\Views;

use Engine\Views\IWebTemplateEngine;
use Modules\User\IUserConfigManagerWeb;

class UserDeleteView
{
    private string $title = 'Внимание!<br>Вы хотите удалить пользователя';
    private string $description = 'Эту операцию невозможно отменить';
    private string $indexTplFile = 'index.tpl.php';
    private string $contentTplFile = 'userDelete.tpl.php';
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
        $this->templateEngine->assignVar('Description', $this->description);

        $this->templateEngine->assignVar('Username', $userData['username']);
        $this->templateEngine->assignVar('Role', $userData['role']);
        $this->templateEngine->assignVar('Date', $userData['date']);

        $this->templateEngine->assignVar('DeleteUser', $this->configManager->getDeleteUserUrl());
        $this->templateEngine->assignVar('ShowUsersList', $this->configManager->getShowUserListUrl());

        $this->templateEngine->setModuleTemplatesPath(__DIR__ . '/Templates/');
        $this->templateEngine->setTemplatesForInjection($this->contentTplFile);
        $this->templateEngine->display($this->indexTplFile);
    }
}
