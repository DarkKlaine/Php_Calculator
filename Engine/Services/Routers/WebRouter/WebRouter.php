<?php

namespace Engine\Services\Routers\WebRouter;

use Engine\Controllers\WebBaseController;
use Engine\IRouter;
use Engine\Services\Container\Container;
use Engine\Services\Routers\AbstractRouter;
use Psr\Log\LoggerInterface;

class WebRouter extends AbstractRouter implements IRouter
{
    private IAuth $auth;
    private IWebConfigManager $configManager;

    public function __construct(
        LoggerInterface   $logger,
        IWebConfigManager $configManager,
        IAuth             $auth,
        Container         $container,
    )
    {
        parent::__construct($logger, $container);
        $this->configManager = $configManager;
        $this->auth = $auth;
    }

    public function handleRequest(): void
    {
        $url = strtok($_SERVER['REQUEST_URI'], '?');
        $routes = $this->configManager->getRoutes();
        $route = $routes[$url] ?? [];

        $this->validateRoute($route);

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
        /** @var WebBaseController $controller */
        $controller = $this->container->get($controllerName);
        $controller->run($request);
    }

    private function validateRoute(array $route): void
    {
        if (empty($route)) {
            $message = 'Ошибка 404';
            $this->logger->debug($message);
            echo $message;
            exit();
        }
    }

}
