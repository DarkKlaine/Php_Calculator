<?php

namespace App\Views;

class CalculatorView
{
    private string $title = 'PHP_Calculator';
    private string $indexTplFile = 'index.tpl.php';
    private string $calculatorTplFile = 'calculator.tpl.php';
    public function render(string $input, string $result): void
    {
        $templateEngine = new TemplateEngine();

        $templateEngine->assignVar('title', $this->title);

        $templateEngine->assignVar('input', $input);

        $templateEngine->assignVar('result', $result);

        $templateEngine->setInjectTplFile($this->calculatorTplFile);

        $templateEngine->display($this->indexTplFile);
    }

}
