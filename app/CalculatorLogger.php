<?php

namespace App;

class CalculatorLogger
{
    protected string $logPath = '../log/calculations.log';
    protected int $maxLogLength = 10;

    public function doNewLog($input, $result): void
    {
        if (str_contains($result, 'Error')) return;

        $textFromFile = file($this->logPath);

        $file = fopen($this->logPath, 'w');

        $text = $input . ' = ' . $result . ' | ' . date('Y-m-d H:i:s');
        fwrite($file, $this->normalizeLogLength($textFromFile) . "\n" . $text);

        fclose($file);
    }

    protected function normalizeLogLength($textFromFile): string
    {
        $logLength = count($textFromFile);
        if ($logLength > ($this->maxLogLength - 1)) {
            array_splice($textFromFile, 0, $logLength - ($this->maxLogLength - 1));
        }
        return implode("", $textFromFile);
    }
}