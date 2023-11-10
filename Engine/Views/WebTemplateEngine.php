<?php

namespace Engine\Views;

class WebTemplateEngine implements IWebTemplateEngine
{
    protected array $vars = [];
    private string $engineTemplatesPath = __DIR__ . '/Templates/';
    private string $moduleTemplatesPath = __DIR__ . '/Templates/';
    private string $injectFile;

    public function assignVar(string $name, mixed $value): void
    {
        $this->vars[$name] = $value;
    }

    public function setInjectTplFile(string $injectFile): void
    {
        $this->injectFile = $this->moduleTemplatesPath . $injectFile;
    }

    public function display(string $tplFile): void
    {
        $template = $this->engineTemplatesPath . $tplFile;
        require_once($template);
    }

    public function setModuleTemplatesPath(string $moduleTemplatesPath): void
    {
        $this->moduleTemplatesPath = $moduleTemplatesPath;
    }

    public function setEngineTemplatesPath(string $engineTemplatesPath): void
    {
        $this->engineTemplatesPath = $engineTemplatesPath;
    }

    private function injectTplFile(): void
    {
        require_once($this->injectFile);
    }
}
