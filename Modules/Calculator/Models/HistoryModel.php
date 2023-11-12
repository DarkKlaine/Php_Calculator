<?php

namespace Modules\Calculator\Models;

class HistoryModel implements IHistoryModel
{
    private string $logDir = __DIR__ . '/../../../Log';
    private string $logFile = __DIR__ . '/../../../Log/History.Log';
    private int $maxLogSize = 10;

    public function addToHistory(string $input, string $result, bool $needSessionHistory): void
    {
        if (is_numeric($result) === false) {
            return;
        }

        $stringForLogging = $input . ' = ' . $result . ' | ' . date('Y-m-d H:i:s') . PHP_EOL;

        $this->addToGlobalHistory($stringForLogging);
        if ($needSessionHistory) {
            $this->addToSessionHistory($stringForLogging);
        }
    }

    private function addToGlobalHistory(string $stringForLogging): void
    {
        if (is_dir($this->logDir) === false) {
            mkdir($this->logDir);
        }

        $logArray = [];
        if (file_exists($this->logFile)) {
            $logArray = file($this->logFile);
            $logArray = $this->trimToMaxSize($logArray);
        }

        $logArray[] = $stringForLogging;
        $logArray = $this->numberingAndPadding($logArray);

        $file = fopen($this->logFile, 'w');
        fwrite($file, implode("", $logArray));
        fclose($file);
    }

    private function trimToMaxSize(array $logArray): array
    {
        $maxLogSize = $this->maxLogSize - 1;
        $logSize = count($logArray);

        if ($logSize > $maxLogSize) {
            array_splice($logArray, 0, $logSize - $maxLogSize);
        }

        return preg_replace('/[ 1-9][0-9]: +/', '', $logArray);
    }

    private function numberingAndPadding(array $logArray): array
    {
        $longestStr = 0;
        foreach ($logArray as $value) {
            $lengthStr = strlen($value);
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

    private function addToSessionHistory(string $stringForLogging): void
    {
        $logArray = [];
        if (isset($_SESSION['history'])) {
            $logArray = $_SESSION['history'];
            $logArray = $this->trimToMaxSize($logArray);
        }

        $logArray[] = $stringForLogging;
        $logArray = $this->numberingAndPadding($logArray);

        $_SESSION['history'] = $logArray;
    }

    public function getGeneralHistoryString(bool $isForWeb): string
    {
        $logArray = file($this->logFile) ?? [];
        return $this->generateHistoryString($logArray, $isForWeb);
    }

    private function generateHistoryString(array $logArray, bool $isForWeb): string
    {
        $historyString = '';

        for ($i = 0; $i < count($logArray); $i++) {
            $historyString .= $logArray[$i];
        }

        if ($isForWeb) {
            $historyString = str_replace(' ', '&nbsp', $historyString);
            $historyString = str_replace(PHP_EOL, '<br>', $historyString);
        }

        return $historyString;
    }

    public function getSessionHistoryString(bool $isForWeb): string
    {
        $logArray = $_SESSION['history'] ?? [];
        return $this->generateHistoryString($logArray, $isForWeb);
    }
}
