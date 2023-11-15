<?php

namespace Modules\Calculator\Models\CalculatorModel;

use Psr\Log\LoggerInterface;

abstract class Computation
{
    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    abstract public function getResult(string $value1, string $action, string $value2 = ''): string;
}
