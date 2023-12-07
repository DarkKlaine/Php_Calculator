<?php

namespace Modules\User\Views;

use Engine\Services\Routers\WebRouter\WebRequestDTO;
use Engine\Views\IWebTemplateEngine;
use Engine\Views\ViewConst;
use Modules\User\Controllers\UserConst;
use Modules\User\IUserConfigManagerWeb;

class UserSetPasswordView
{
    private string $title = 'Придумайте пароль';
    private string $description = 'Может состоять из 2–12 букв или цифр';
    private string $errorMsg = '<br><br><span style="color: red;">Пароли не совпадают</span>';
    private string $indexTplFile = 'index.tpl.php';
    private string $contentTplFile = 'setPassword.tpl.php';
    private string $pswScriptTplFile = 'psw.script.tpl.php';
    private IWebTemplateEngine $templateEngine;
    private IUserConfigManagerWeb $configManager;

    public function __construct(IWebTemplateEngine $templateEngine, IUserConfigManagerWeb $configManager)
    {
        $this->templateEngine = $templateEngine;
        $this->configManager = $configManager;
    }

    public function render(?string $username, ?string $usernameOld, string $operation, bool $passwordMismatch = false): void
    {
        $required = $operation === UserConst::CREATE ? ViewConst::REQUIRED : '';
        $errorMsg = $passwordMismatch ? $this->errorMsg : '';
        $frameStyle = $passwordMismatch ? 'is-invalid' : 'border-end-0';

        $this->templateEngine->assignVar(ViewConst::TITLE, $this->title);
        $this->templateEngine->assignVar(ViewConst::DESCRIPTION, $this->description);
        $this->templateEngine->assignVar(ViewConst::ERROR_MSG, $errorMsg);

        $this->templateEngine->assignVar(ViewConst::ACTION, $this->configManager->getSetRoleUrl());
        $this->templateEngine->assignVar(UserConst::OPERATION, $operation);
        $this->templateEngine->assignVar(UserConst::USERNAME, $username);
        $this->templateEngine->assignVar(UserConst::USERNAME_OLD, $usernameOld);
        $this->templateEngine->assignVar(ViewConst::FRAME_STYLE, $frameStyle);
        $this->templateEngine->assignVar(ViewConst::REQUIRED, $required);

        $this->templateEngine->setModuleTemplatesPath(__DIR__ . '/Templates/');
        $this->templateEngine->setTemplatesForInjection($this->contentTplFile, scriptTpl: $this->pswScriptTplFile);
        $this->templateEngine->display($this->indexTplFile);
    }
}
