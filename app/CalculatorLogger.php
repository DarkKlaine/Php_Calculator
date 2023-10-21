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

        $this->rawLogProcessing($input, $result);
        $this->finalLogProcessing();
    }

    protected function rawLogProcessing($input, $result): void
    {
        $existingLog = '';

        if (file_exists($this->rawLogPath)) {
            $existingLog = $this->trimLogLength(file($this->rawLogPath)) . "\n";
        }

        $file = fopen($this->rawLogPath, 'w');

        $textToFile = $existingLog . $input . ' = ' . $result . ' | ' . date('Y-m-d H:i:s');

        fwrite($file, $textToFile);
        fclose($file);
    }

    protected function trimLogLength(array $rawLog): string
    {
        $logLength = count($rawLog);
        if ($logLength > ($this->maxLogLength - 1)) {
            array_splice($rawLog, 0, $logLength - ($this->maxLogLength - 1));
        }
        return implode("", $rawLog);
    }

    protected function finalLogProcessing(): void
    {
        $rawLog = file($this->rawLogPath);
        $maxElementLength = 0;
        for ($i = 0; $i < count($rawLog); $i++) {
            $elementLength = strlen($rawLog[$i]);
            if ($elementLength > $maxElementLength) {
                $maxElementLength = $elementLength;
            }
        }

        foreach ($rawLog as $key => &$value) {
            $number = $key < 9 ? ' ' . ($key + 1) . ': ' : ($key + 1) . ':';
            $value = $number . str_repeat(' ', $maxElementLength - strlen($value)) . $value;
        }
        unset($value);

        $file = fopen($this->logPath, 'w');
        fwrite($file, implode("", $rawLog));
        fclose($file);

    }
}
