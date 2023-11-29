<?php

namespace Engine\Views;

interface IWebTemplateEngine
{
    public function assignVar(string $name, mixed $value): void;

    public function setInjectTplFile(string $contentTpl, ?string $menuTpl = null, ?string $scriptTpl = null): void;

    public function display(string $tplFile): void;

    public function setModuleTemplatesPath(string $moduleTemplatesPath): void;

    public function setEngineTemplatesPath(string $engineTemplatesPath): void;
}