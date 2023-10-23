<?php

namespace App;

use Psr\Log\LoggerInterface;

class PSRLogger implements LoggerInterface
{

    protected string $logDir = '../log';
    protected string $logFile = '../log/calculations.log';
    protected int $maxLogSize = 10;

    public function emergency(\Stringable|string $message, array $context = []): void
    {

    }

    public function alert(\Stringable|string $message, array $context = []): void
    {

    }

    public function critical(\Stringable|string $message, array $context = []): void
    {

    }

    public function error(\Stringable|string $message, array $context = []): void
    {

    }

    public function warning(\Stringable|string $message, array $context = []): void
    {

    }
    public function notice(\Stringable|string $message, array $context = []): void
    {

    }

    public function info(\Stringable|string $message, array $context = []): void
    {

    }

    public function debug(\Stringable|string $message, array $context = []): void
    {

    }

    public function log($level, \Stringable|string $message, array $context = []): void
    {
        (new CalculatorLogger())->addToLog($context[0], $context[1]);
        // $this->addToLog($context[0], $context[1]);
    }

//    protected function addToLog(string $input, string $result): void
//    {
//        if (str_contains($result, 'Error')) return;
//
//        $textForLogging = $input . ' = ' . $result . ' | ' . date('Y-m-d H:i:s') . PHP_EOL;
//
//        if (file_exists($this->logFile)) {
//            $logArray = $this->parseLog();
//            $logArray[] = $textForLogging;
//        } else {
//            mkdir($this->logDir);
//            $logArray = array($textForLogging);
//        }
//
//        $logArray = $this->processLog($logArray);
//
//        $file = fopen($this->logFile, 'w');
//        fwrite($file, implode("", $logArray));
//        fclose($file);
//
//    }
//
//    protected function parseLog(): array
//    {
//        $logArray = file($this->logFile);
//        $logSize = count($logArray);
//
//        if ($logSize > ($this->maxLogSize - 1)) {
//            array_splice($logArray, 0, $logSize - ($this->maxLogSize - 1));
//        }
//
//        return preg_replace('/[ 1-9][0-9]: +/', '', $logArray);
//    }
//
//    protected function processLog(array $logArray): array
//    {
//        $longestStr = 0;
//        for ($i = 0; $i < count($logArray); $i++) {
//            $lengthStr = strlen($logArray[$i]);
//            if ($lengthStr > $longestStr) {
//                $longestStr = $lengthStr;
//            }
//        }
//
//        foreach ($logArray as $key => &$value) {
//            $number = $key < 9 ? ' ' . ($key + 1) : ($key + 1);
//            $value = $number . ': ' . str_pad($value, $longestStr, ' ', STR_PAD_LEFT);
//        }
//        unset($value);
//
//        return $logArray;
//    }

}