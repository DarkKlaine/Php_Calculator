<?php

namespace Engine\Views;

interface IWebTemplateEngine
{
    public function assignVar(string $name, mixed $value): void;

    public function setInjectTplFile(?string $linksTpl, string $contentTpl, ?string $scriptTpl): void;

    public function display(string $tplFile): void;

    public function setModuleTemplatesPath(string $moduleTemplatesPath): void;

    public function setEngineTemplatesPath(string $engineTemplatesPath): void;
}