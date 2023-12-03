<?php

namespace Modules\User\Views;

use Engine\Services\Routers\WebRouter\WebRequestDTO;
use Engine\Views\IWebTemplateEngine;
use Modules\User\IUserConfigManagerWeb;

class UserSetPasswordView
{
    private string $title = 'Придумайте пароль';
    private string $description = 'Может состоять из 2–12 букв или цифр';
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

    public function render(WebRequestDTO $request, string $operation, bool $passwordMismatch = false): void
    {
        $required = '';
        if ($operation === 'Create') {
            $required = 'required ';
        }

        $frameStyle = 'border-end-0';
        if ($passwordMismatch) {
            $this->templateEngine->assignVar(
                'ErrorMessage',
                '<br><br><span style="color: red;">Пароли не совпадают</span>'
            );
            $frameStyle = 'is-invalid';
        }

        $username = $request->getPost()['username'] ?? '';

        $this->templateEngine->assignVar('Title', $this->title);
        $this->templateEngine->assignVar('Description', $this->description);

        $this->templateEngine->assignVar('Action', $this->configManager->getSetRoleUrl());
        $this->templateEngine->assignVar('Username', $username);
        $this->templateEngine->assignVar('Operation', $operation);
        $this->templateEngine->assignVar('CurrentUsername', $request->getPost()['currentUsername'] ?? '');
        $this->templateEngine->assignVar('FrameStyle', $frameStyle);
        $this->templateEngine->assignVar('Required', $required);

        $this->templateEngine->setModuleTemplatesPath(__DIR__ . '/Templates/');
        $this->templateEngine->setTemplatesForInjection($this->contentTplFile, scriptTpl: $this->pswScriptTplFile);
        $this->templateEngine->display($this->indexTplFile);
    }
}
