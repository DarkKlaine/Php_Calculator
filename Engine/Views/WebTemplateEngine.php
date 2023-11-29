<?php

namespace Engine\Views;

class WebTemplateEngine implements IWebTemplateEngine
{
    protected array $vars = [];
    private string $engineTemplatesPath = __DIR__ . '/Templates/';
    private string $moduleTemplatesPath = __DIR__ . '/Templates/';
    private ?string $menuTpl;
    private string $contentTpl;
    private ?string $scriptTpl;

    public function assignVar(string $name, mixed $value): void
    {
        $this->vars[$name] = $value;
    }

    public function setInjectTplFile(string $contentTpl, ?string $menuTpl = null, ?string $scriptTpl = null): void
    {
        $this->menuTpl = $menuTpl;
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

    private function injectMenuTpl(): void
    {
        if ($this->menuTpl !== null) {
            require($this->moduleTemplatesPath . $this->menuTpl);
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
