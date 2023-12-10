<?php

namespace Modules\User\Views;

use Engine\Views\IWebTemplateEngine;
use Engine\Views\ViewConst;
use Modules\User\Controllers\UserConst;
use Modules\User\IUserConfigManagerWeb;

class UserSetUsernameView
{
    private string $title = 'Придумайте имя<br>пользователя';
    private string $description = 'Может состоять из 2–12 букв или цифр';
    private string $errorMsg = '<br><br><span style="color: red;">Такой пользователь уже существует</span>';
    private string $indexTplFile = 'index.tpl.php';
    private string $registerUsernameTplFile = 'setUsername.tpl.php';
    private IWebTemplateEngine $templateEngine;
    private IUserConfigManagerWeb $configManager;

    public function __construct(
        IWebTemplateEngine $templateEngine,
        IUserConfigManagerWeb $configManager
    ) {
        $this->templateEngine = $templateEngine;
        $this->configManager = $configManager;
    }

    public function render(?string $usernameOld, string $operation, bool $alreadyExist = false): void
    {
        $required = $operation === UserConst::CREATE ? ViewConst::REQUIRED : '';
        $errorMsg = $alreadyExist ? $this->errorMsg : '';
        $frameStyle = $alreadyExist ? 'is-invalid' : '';

        $this->templateEngine->assignVar(ViewConst::TITLE, $this->title);
        $this->templateEngine->assignVar(ViewConst::DESCRIPTION, $this->description);
        $this->templateEngine->assignVar(ViewConst::ERROR_MSG, $errorMsg);

        $this->templateEngine->assignVar(ViewConst::ACTION, $this->configManager->getSetPasswordUrl());
        $this->templateEngine->assignVar(UserConst::OPERATION, $operation);
        $this->templateEngine->assignVar(UserConst::USERNAME_OLD, $usernameOld);
        $this->templateEngine->assignVar(ViewConst::FRAME_STYLE, $frameStyle);
        $this->templateEngine->assignVar(ViewConst::REQUIRED, $required);

        $this->templateEngine->setModuleTemplatesPath(__DIR__ . '/Templates/');
        $this->templateEngine->setTemplatesForInjection($this->registerUsernameTplFile);
        $this->templateEngine->display($this->indexTplFile);
    }
}
