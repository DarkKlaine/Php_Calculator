<?php

namespace Modules\Calculator\Computations;

use Engine\Container\Container;
use Engine\Models\Logger\EngineLogger;
use Psr\Log\LoggerInterface;

abstract class Computation
{
    protected string $value1;
    protected string $value2;
    protected string $action;
    protected string|float $result;
    protected LoggerInterface $logger;

    public function __construct(Container $container)
    {
        $this->logger = $container->get(LoggerInterface::class);
    }

    public function getResult(string $value1, string $action, string $value2 = ''): string|float
    {
        $this->value1 = $value1;
        $this->action = $action;
        $this->value2 = $value2;
        $this->calculate();
        return $this->result;
    }

    abstract public function calculate(): void;
}
