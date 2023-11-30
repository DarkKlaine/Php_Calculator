<?php

namespace Modules\User\Views;

use Engine\Views\IWebTemplateEngine;
use Modules\User\IUserConfigManagerWeb;

class UserRegisterUsernameView
{
    private string $indexTplFile = 'index.tpl.php';
    private string $registerUsernameTplFile = 'registerUsername.tpl.php';
    private IWebTemplateEngine $templateEngine;
    private IUserConfigManagerWeb $configManager;

    public function __construct(IWebTemplateEngine $templateEngine, IUserConfigManagerWeb $configManager)
    {
        $this->templateEngine = $templateEngine;
        $this->configManager = $configManager;
    }
    public function render(): void
    {
        $this->templateEngine->setModuleTemplatesPath(__DIR__ . '/Templates/');

        $this->templateEngine->assignVar('Action', $this->configManager->getSetPasswordUrl());

        $this->templateEngine->setTemplatesForInjection($this->registerUsernameTplFile);

        $this->templateEngine->display($this->indexTplFile);
    }
}