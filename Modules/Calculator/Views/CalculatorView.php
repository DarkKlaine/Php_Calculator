<?php
/**
 * uses App/Views/Templates/calculator.tpl.php
 */

namespace Modules\Calculator\Views;

use Engine\Views\IWebTemplateEngine;
use Modules\Calculator\Controllers\ICalculatorView;

class CalculatorView implements ICalculatorView
{
    private string $title = 'PHP_Calculator';
    private string $indexTplFile = 'index.tpl.php';
    private string $calculatorTplFile = 'calculator.tpl.php';

    private IWebTemplateEngine $templateEngine;

    public function __construct(IWebTemplateEngine $templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }
    public function render(string $input, string $result): void
    {
        $this->templateEngine->setModuleTemplatesPath(__DIR__ . '/Templates/');

        $this->templateEngine->assignVar('title', $this->title);

        $this->templateEngine->assignVar('input', $input);

        $this->templateEngine->assignVar('result', $result);

        $this->templateEngine->setInjectTplFile($this->calculatorTplFile);

        $this->templateEngine->display($this->indexTplFile);
    }
}
