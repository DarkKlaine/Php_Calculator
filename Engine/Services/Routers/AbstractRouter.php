<?php

namespace Engine\Services\Routers;

use Engine\Services\Container\Container;
use Psr\Log\LoggerInterface;

abstract class AbstractRouter
{
    protected LoggerInterface $logger;
    protected Container $container;

    public function __construct(
        LoggerInterface $logger,
        Container $container,
    ) {
        $this->logger = $logger;
        $this->container = $container;
    }

    abstract public function handleRequest(): void;

}
