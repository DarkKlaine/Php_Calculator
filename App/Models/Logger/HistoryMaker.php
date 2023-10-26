<?php

namespace App;

class HistoryMaker
{
    protected string $logDir = '../Log';
    protected string $logFile = '../Log/History.Log';
    protected int $maxLogSize = 10;

    public function addToHistory(string $input, string $result): void
    {
        if (str_contains($result, 'Error')) return;

        $textForLogging = $input . ' = ' . $result . ' | ' . date('Y-m-d H:i:s') . PHP_EOL;

        if (file_exists($this->logFile)) {
            $logArray = $this->parseHistory();
            $logArray[] = $textForLogging;
        } else {
            mkdir($this->logDir);
            $logArray = array($textForLogging);
        }

        $logArray = $this->processHistory($logArray);

        $file = fopen($this->logFile, 'w');
        fwrite($file, implode("", $logArray));
        fclose($file);

    }

    protected function parseHistory(): array
    {
        $logArray = file($this->logFile);
        $logSize = count($logArray);

        if ($logSize > ($this->maxLogSize - 1)) {
            array_splice($logArray, 0, $logSize - ($this->maxLogSize - 1));
        }

        return preg_replace('/[ 1-9][0-9]: +/', '', $logArray);
    }

    protected function processHistory(array $logArray): array
    {
        $longestStr = 0;
        for ($i = 0; $i < count($logArray); $i++) {
            $lengthStr = strlen($logArray[$i]);
            if ($lengthStr > $longestStr) {
                $longestStr = $lengthStr;
            }
        }

        foreach ($logArray as $key => &$value) {
            $number = $key < 9 ? ' ' . ($key + 1) : ($key + 1);
            $value = $number . ': ' . str_pad($value, $longestStr, ' ', STR_PAD_LEFT);
        }
        unset($value);

        return $logArray;
    }

}
