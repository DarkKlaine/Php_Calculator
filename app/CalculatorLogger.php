<?php

namespace App;

class CalculatorLogger
{
    protected string $rawLogPath = '../log/rawLogData.log';
    protected string $logPath = '../log/calculations.log';
    protected int $maxLogLength = 10;

    public function doNewLog($input, $result): void
    {
        if (str_contains($result, 'Error')) {
            return;
        }

        $normalizedLog = '';

        if (file_exists($this->rawLogPath)) {
            $normalizedLog = $this->normalizeLogLength(file($this->rawLogPath)) . "\n";
        }

        $file = fopen($this->rawLogPath, 'w');

        $textToFile = $normalizedLog . $input . ' = ' . $result . ' | ' . date('Y-m-d H:i:s');

        fwrite($file, $textToFile);
        fclose($file);

        $this->finalLogProcessing();
    }

    protected function normalizeLogLength(array $textFromFile): string
    {
        $logLength = count($textFromFile);
        if ($logLength > ($this->maxLogLength - 1)) {
            array_splice($textFromFile, 0, $logLength - ($this->maxLogLength - 1));
        }
        return implode("", $textFromFile);
    }

    protected function finalLogProcessing(): void
    {
        $array = file($this->rawLogPath);
        $maxElementLength = 0;
        for ($i = 0; $i < count($array); $i++) {
            $elementLength = strlen($array[$i]);
            if ($elementLength > $maxElementLength) {
                $maxElementLength = $elementLength;
            }
        }

        foreach ($array as $key => &$value) {
            $number = $key < 9 ? ' ' . ($key + 1) . ' -  ' : ($key + 1) . ' - ';
            $value = $number . str_repeat(' ', $maxElementLength - strlen($value)) . $value;
        }
        unset($value);

        $file = fopen($this->logPath, 'w');
        fwrite($file, implode("", $array));
        fclose($file);

    }
}