<?php

namespace Engine\Views;

interface ITemplateEngine
{
    public function assignVar(string $name, mixed $value): void;

    public function setInjectTplFile(string $injectFile): void;

    public function display(string $tplFile): void;

    public function setModuleTemplatesPath(string $moduleTemplatesPath): void;

    public function setEngineTemplatesPath(string $engineTemplatesPath): void;
}