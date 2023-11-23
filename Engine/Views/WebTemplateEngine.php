<?php

namespace Engine\Views;

class WebTemplateEngine implements IWebTemplateEngine
{
    protected array $vars = [];
    private string $engineTemplatesPath = __DIR__ . '/Templates/';
    private string $moduleTemplatesPath = __DIR__ . '/Templates/';
    private ?string $linksTpl;
    private string $contentTpl;
    private ?string $scriptTpl;

    public function assignVar(string $name, mixed $value): void
    {
        $this->vars[$name] = $value;
    }

    public function setInjectTplFile(?string $linksTpl, string $contentTpl, ?string $scriptTpl): void
    {
        $this->linksTpl = $linksTpl;
        $this->contentTpl = $contentTpl;
        $this->scriptTpl = $scriptTpl;
    }

    public function display(string $tplFile): void
    {
        $template = $this->engineTemplatesPath . $tplFile;
        require($template);
    }

    public function setModuleTemplatesPath(string $moduleTemplatesPath): void
    {
        $this->moduleTemplatesPath = $moduleTemplatesPath;
    }

    public function setEngineTemplatesPath(string $engineTemplatesPath): void
    {
        $this->engineTemplatesPath = $engineTemplatesPath;
    }

    private function injectLinksTpl(): void
    {
        if ($this->linksTpl !== null) {
            require($this->engineTemplatesPath . $this->linksTpl);
        }
    }

    private function injectContentTpl(): void
    {
        require($this->moduleTemplatesPath . $this->contentTpl);
    }

    private function injectScriptTpl(): void
    {
        if ($this->scriptTpl !== null) {
            require($this->engineTemplatesPath . $this->scriptTpl);
        }
    }
}
