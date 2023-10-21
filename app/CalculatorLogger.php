<?php

namespace App;

class CalculatorLogger
{

    protected string $logPath = '../log/calculations.log';
    protected int $maxLogSize = 10;

    public function addToLog(string $input, string $result): void
    {
        if (str_contains($result, 'Error')) return;

        $textForLogging = $input . ' = ' . $result . ' | ' . date('Y-m-d H:i:s') . "\n";

        if (file_exists($this->logPath)) {
            $logArray = $this->parseLog();
            $logArray[] = $textForLogging;
        } else {
            $logArray = array($textForLogging);
        }

        $logArray = $this->processLog($logArray);

        $file = fopen($this->logPath, 'w');
        fwrite($file, implode("", $logArray));
        fclose($file);
    }

    protected function parseLog(): array
    {
        $logArray = file($this->logPath);
        $logSize = count($logArray);

        if ($logSize > ($this->maxLogSize - 1)) {
            array_splice($logArray, 0, $logSize - ($this->maxLogSize - 1));
        }

        return preg_replace('/[ 1-9][0-9]: +/', '', $logArray);
    }

    protected function processLog(array $logArray): array
    {
        $longestStr = 0;
        for ($i = 0; $i < count($logArray); $i++) {
            $lengthStr = strlen($logArray[$i]);
            if ($lengthStr > $longestStr) {
                $longestStr = $lengthStr;
            }
        }

        foreach ($logArray as $key => &$value) {
            $number = $key < 9 ? ' ' . ($key + 1) . ': ' : ($key + 1) . ': ';
            $value = $number . str_pad($value, $longestStr, ' ', STR_PAD_LEFT);
            //$value = $number . str_repeat(' ', $longestStr - strlen($value)) . $value;
        }
        unset($value);

        return $logArray;
    }

}
