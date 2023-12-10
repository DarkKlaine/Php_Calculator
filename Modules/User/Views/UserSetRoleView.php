<?php

namespace Modules\User\Views;

use Engine\Services\Routers\WebRouter\WebRequestDTO;
use Engine\Views\IWebTemplateEngine;
use Engine\Views\ViewConst;
use Modules\User\Controllers\UserConst;
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

    public function render(?string $username, ?string $usernameOld, string $operation, string $passwordHash): void
    {
        $this->templateEngine->assignVar(ViewConst::TITLE, $this->title);
        $this->templateEngine->assignVar(ViewConst::DESCRIPTION, $this->description);

        $this->templateEngine->assignVar(ViewConst::ACTION, $this->configManager->getRecordUserDataUrl());
        $this->templateEngine->assignVar(UserConst::OPERATION, $operation);
        $this->templateEngine->assignVar(UserConst::USERNAME, $username);
        $this->templateEngine->assignVar(UserConst::USERNAME_OLD, $usernameOld);
        $this->templateEngine->assignVar(UserConst::PASSWORD, $passwordHash);

        $this->templateEngine->setModuleTemplatesPath(__DIR__ . '/Templates/');
        $this->templateEngine->setTemplatesForInjection($this->contentTplFile);
        $this->templateEngine->display($this->indexTplFile);
    }
}
