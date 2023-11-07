<?php
/**
 * uses App/Views/Templates/calculator.tpl.php
 */

namespace Modules\Calculator;

use Engine\Container\Container;
use Engine\Views\ITemplateEngine;

class CalculatorView implements ICalculatorView
{
    private string $title = 'PHP_Calculator';
    private string $indexTplFile = 'index.tpl.php';
    private string $calculatorTplFile = 'calculator.tpl.php';

    private ITemplateEngine $templateEngine;

    public function __construct(Container $container)
    {
        $this->templateEngine = $container->get(ITemplateEngine::class);
    }
    public function render(string $input, string $result): void
    {
        $this->templateEngine->setModuleTemplatesPath('../Config/Templates/');

        $this->templateEngine->assignVar('title', $this->title);

        $this->templateEngine->assignVar('input', $input);

        $this->templateEngine->assignVar('result', $result);

        $this->templateEngine->setInjectTplFile($this->calculatorTplFile);

        $this->templateEngine->display($this->indexTplFile);
    }
}
