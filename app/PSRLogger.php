<?php

namespace App;

use Psr\Log\LogLevel;

class PSRLogger implements \Psr\Log\LoggerInterface
{

    protected string $logDir = '../log';
    protected string $logFile = '../log/appLog.log';

    public function emergency(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement emergency() method.
    }

    public function alert(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement alert() method.
    }

    public function critical(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement critical() method.
    }

    public function error(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement error() method.
    }

    public function warning(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement warning() method.
    }

    public function notice(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement notice() method.
    }

    public function info(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement info() method.
    }

    public function debug(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement debug() method.
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