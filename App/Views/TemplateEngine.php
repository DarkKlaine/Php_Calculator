<?php

namespace App\Views;

class TemplateEngine
{
    private string $templatesDirPath = '../App/Views/Templates/';
    protected array $vars = [];
    private string $injectFile;

    public function assignVar(string $name, mixed $value): void
    {
        $this->vars[$name] = $value;
    }

    public function setInjectTplFile(string $injectFile): void
    {
        $this->injectFile = $this->templatesDirPath . $injectFile;
    }

    public function display(string $tplFile): void
    {
        $template = $this->templatesDirPath . $tplFile;
        require_once($template);
    }

    private function injectTplFile(): void
    {
        require_once($this->injectFile);
    }
}