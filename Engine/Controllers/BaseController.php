<?php

namespace Engine\Controllers;

use Engine\Container\ContainerInterface;
use Engine\DTO\ConfigDTO;
use Engine\DTO\Request;
use Engine\Interfaces\RedirectHandler;
use Psr\Log\LoggerInterface;

class BaseController
{
    protected ContainerInterface $container;
    protected object $redirectHandler;
    protected object $logger;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->logger = $container->get('EngineLogger');
        $this->redirectHandler = $container->get('RedirectHandler');
    }
    public function run(Request $request): void
    {
        $action = $request->getAction();

        if (method_exists($this, $action)) {
            $this->$action($request);
        } else {

            $this->logger->error("Ошибка в BaseController. Неправильный 'action' в routes.php.");
            header("Location: " . ConfigDTO::$homeUrl);
            exit;
        }
    }
}
