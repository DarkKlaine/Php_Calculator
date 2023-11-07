<?php
/**
 * uses App/Views/Templates/calculator.tpl.php
 */

namespace Modules\Calculator\Views;

use Engine\Container\Container;
use Engine\Views\ITemplateEngine;
use Modules\Calculator\Controllers\ICalculatorView;

class CalculatorView implements ICalculatorView
{
    private string $title = 'PHP_Calculator';
    private string $indexTplFile = 'index.tpl.php';
    private string $calculatorTplFile = 'calculator.tpl.php';

    private ITemplateEngine $templateEngine;

    public function __construct(ITemplateEngine $templateEngine)
    {
        $this->templateEngine = $templateEngine;
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
