<?php

namespace Engine\Views;

use Engine\Models\IAuthSessionHandler;

class EngineHomePageView
{
    private string $title = 'DK Engine';
    private string $indexTplFile = 'index.tpl.php';
    private string $engineHomeTplFile = 'engineHome.tpl.php';
    private IWebTemplateEngine $templateEngine;
    private IAuthSessionHandler $authSessionHandler;

    public function __construct(IWebTemplateEngine $templateEngine, IAuthSessionHandler $authSessionHandler)
    {
        $this->templateEngine = $templateEngine;
        $this->authSessionHandler = $authSessionHandler;
    }

    public function render(): void
    {
        $this->templateEngine->assignVar('title', $this->title);

        $this->templateEngine->assignVar('IsAuthorized', $this->authSessionHandler->getIsAuthorized());

        $this->templateEngine->setTemplatesForInjection($this->engineHomeTplFile);

        $this->templateEngine->display($this->indexTplFile);
    }
}
