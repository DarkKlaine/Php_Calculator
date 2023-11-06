<?php

namespace Modules\Calculator;

class HistoryModel implements IHistoryModel
{
    private string $logDir = '../Log';
    private string $logFile = '../Log/History.Log';
    private int $maxLogSize = 10;

    public function addToHistory(string $input, string $result): void
    {
        if (is_numeric($result) === false) {
            return;
        }

        $stringForLogging = $input . ' = ' . $result . ' | ' . date('Y-m-d H:i:s') . PHP_EOL;

        $this->addToGlobalHistory($stringForLogging);
        $this->addToSessionHistory($stringForLogging);
    }

    private function addToGlobalHistory(string $stringForLogging): void
    {
        mkdir($this->logDir);
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

    private function addToSessionHistory(string $stringForLogging): void
    {
        if (isset($_SESSION['history'])) {
            $logArray = $_SESSION['history'];
            $logArray = $this->trimToMaxSize($logArray);
        }

        $logArray[] = $stringForLogging;
        $logArray = $this->numberingAndPadding($logArray);

        $_SESSION['history'] = $logArray;
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

    public function getGeneralHistoryString(): string
    {
        $historyString = '';
        if (file_exists($this->logFile)) {
            $logArray = file($this->logFile);
            for ($i = 0; $i < count($logArray); $i++) {
                $historyString .= str_replace(' ', '&nbsp', $logArray[$i]) . '<br>';
            }
        }
        return $historyString;
    }

    public function getSessionHistoryString(): string
    {
        $historyString = '';
        if (isset($_SESSION['history'])) {
            $logArray = $_SESSION['history'];
            for ($i = 0; $i < count($logArray); $i++) {
                $historyString .= str_replace(' ', '&nbsp', $logArray[$i]) . '<br>';
            }
        }
        return $historyString;
    }
}
