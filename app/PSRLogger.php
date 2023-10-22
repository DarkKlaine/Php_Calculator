<?php

namespace App;

use Psr\Log\LogLevel;

class PSRLogger implements \Psr\Log\LoggerInterface
{

    protected string $logDir = '../log';
    protected string $logFile = '../log/appLog.log';

    public function emergency(\Stringable|string $message, array $context = []): void
    {
        $this->log(LogLevel::EMERGENCY, $message, $context = []);
    }

    public function alert(\Stringable|string $message, array $context = []): void
    {
        $this->log(LogLevel::ALERT, $message, $context = []);
    }

    public function critical(\Stringable|string $message, array $context = []): void
    {
        $this->log(LogLevel::CRITICAL, $message, $context = []);
    }

    public function error(\Stringable|string $message, array $context = []): void
    {
        $this->log(LogLevel::ERROR, $message, $context = []);
    }

    public function warning(\Stringable|string $message, array $context = []): void
    {
        $this->log(LogLevel::WARNING, $message, $context = []);
    }

    public function notice(\Stringable|string $message, array $context = []): void
    {
        $this->log(LogLevel::NOTICE, $message, $context = []);
    }

    public function info(\Stringable|string $message, array $context = []): void
    {
        $this->log(LogLevel::INFO, $message, $context = []);
    }

    public function debug(\Stringable|string $message, array $context = []): void
    {
        $this->log(LogLevel::DEBUG, $message, $context = []);
    }

    public function log($level, \Stringable|string $message, array $context = []): void
    {
        $levels = new \ReflectionClass(LogLevel::class);
        if (in_array($level, $levels->getConstants()) === false) {
            $message = "Wrong level: {$level}.";
            $level = LogLevel::INFO;
        }
        $date = date('Y-m-d H:i:s');
        $message = sprintf('%s | %s: %s', $date, $level, $message) . PHP_EOL;

        file_put_contents($this->logFile, $message, FILE_APPEND);
    }
}