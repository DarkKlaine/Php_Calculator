<?php

namespace Modules\User\Views;

use Engine\Services\Routers\WebRouter\WebRequestDTO;
use Engine\Views\IWebTemplateEngine;
use Modules\User\IUserConfigManagerWeb;

class UserSetUsernameView
{
    private string $title = 'Придумайте имя<br>пользователя';
    private string $description = 'Может состоять из 2–12 букв или цифр';
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

    public function render(WebRequestDTO $request, string $operation, bool $alreadyExist = false): void
    {
        $required = '';
        if ($operation === 'Create') {
            $required = 'required ';
        }

        if ($alreadyExist) {
            $this->templateEngine->assignVar(
                'ErrorMessage',
                '<br><br><span style="color: red;">Такой пользователь уже существует</span>'
            );
            $this->templateEngine->assignVar('FrameStyle', 'is-invalid');
        }

        $this->templateEngine->assignVar('Title', $this->title);
        $this->templateEngine->assignVar('Description', $this->description);

        $this->templateEngine->assignVar('Action', $this->configManager->getSetPasswordUrl());
        $this->templateEngine->assignVar('Operation', $operation);
        $this->templateEngine->assignVar('CurrentUsername', $request->getPost()['currentUsername'] ?? '');
        $this->templateEngine->assignVar('Required', $required);

        $this->templateEngine->setModuleTemplatesPath(__DIR__ . '/Templates/');
        $this->templateEngine->setTemplatesForInjection($this->registerUsernameTplFile);
        $this->templateEngine->display($this->indexTplFile);
    }
}
