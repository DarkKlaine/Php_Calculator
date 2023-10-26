<?php

namespace App;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class CalculatorLogger implements LoggerInterface
{
    protected string $logFile = '../Log/Calculator.Log';

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
        $this->log(LogLevel::ERROR, $message);
    }

    public function warning(\Stringable|string $message, array $context = []): void
    {

    }
    public function notice(\Stringable|string $message, array $context = []): void
    {

    }

    public function info(\Stringable|string $message, array $context = []): void
    {
        $this->log(LogLevel::INFO, $message);
    }

    public function debug(\Stringable|string $message, array $context = []): void
    {

    }

    public function log($level, \Stringable|string $message, array $context = []): void
    {
        date_default_timezone_set('Europe/Moscow');
        $logEntry = date("Y-m-d H:i:s") . " | " . $level . " -> " . $message . "\n";
        file_put_contents($this->logFile, $logEntry, FILE_APPEND);
    }

}