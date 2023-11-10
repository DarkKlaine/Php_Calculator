<?php

namespace Engine\Router;

use Engine\Controllers\BaseController;
use Engine\DTO\WebRequestDTO;
use Engine\IWebRouter;
use Engine\Services\Container\Container;
use Psr\Log\LoggerInterface;

class WebRouter implements IWebRouter
{
    private IAuth $auth;
    private LoggerInterface $logger;
    private Container $container;
    private IWebConfigManager $configManager;

    public function __construct(
        LoggerInterface   $logger,
        IWebConfigManager $configManager,
        IAuth             $auth,
        Container         $container,
    )
    {
        $this->logger = $logger;
        $this->configManager = $configManager;
        $this->auth = $auth;
        $this->container = $container;
    }

    public function handleRequest(): void
    {
        $url = strtok($_SERVER['REQUEST_URI'], '?');
        $routes = $this->configManager->getRoutes();
        $route = $routes[$url];

        if (empty($route) === false) {
            $request = new WebRequestDTO(
                $_POST,
                $_GET,
                $route['action'] ?? '',
                $url,
            );

            if ($this->configManager->isAuthEnabled()) {
                $this->auth->verifyAuth($url);
            }

            $controllerName = $route['controller'];
            /** @var BaseController $controller */
            $controller = $this->container->get($controllerName);
            $controller->run($request);
        } else {
            $message = 'Ошибка 404. Запрос: ' . $url;
            $this->logger->debug($message);
            echo $message;
        }
    }
}
