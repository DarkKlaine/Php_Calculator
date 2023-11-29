<?php

namespace Engine\Views;

class EngineHomePageView implements IEngineHomePageView
{
    private string $title = 'DK Engine';
    private string $indexTplFile = 'index.tpl.php';
    private string $engineHomeTplFile = 'engineHome.tpl.php';
    private IWebTemplateEngine $templateEngine;

    public function __construct(IWebTemplateEngine $templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }

    public function render(): void
    {
        $this->templateEngine->assignVar('title', $this->title);

        $this->templateEngine->setInjectTplFile($this->engineHomeTplFile);

        $this->templateEngine->display($this->indexTplFile);
    }
}