<?php

namespace Engine\Router;

use Engine\Services\Container\Container;
use Psr\Log\LoggerInterface;

class AbstractRouter
{
    protected LoggerInterface $logger;
    protected Container $container;

    public function __construct(
        LoggerInterface   $logger,
        Container         $container,
    )
    {
        $this->logger = $logger;
        $this->container = $container;
    }



}