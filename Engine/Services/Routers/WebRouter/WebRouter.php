<?php

namespace Engine\Services\Routers\WebRouter;

use Engine\Controllers\WebBaseController;
use Engine\IRouter;
use Engine\Services\ConfigManagers\IAuthConfigManagerWeb;
use Engine\Services\Container\Container;
use Engine\Services\Routers\AbstractRouter;
use Psr\Log\LoggerInterface;

class WebRouter extends AbstractRouter implements IRouter
{
    private IAuth $auth;
    private IAuthConfigManagerWeb $configManager;

    public function __construct(
        LoggerInterface   $logger,
        IAuthConfigManagerWeb $configManager,
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
        $requestUri = $_SERVER['REQUEST_URI'];
        if (str_contains($requestUri, '/?')) {
            $requestUri = strstr($requestUri, '/?', true);
        }

        $routes = $this->configManager->getRoutes();
        $route = [];

        foreach ($routes as $key => $value) {
            if ($value['url'] === $requestUri) {
                $route = $value;
                break;
            }
        }

        $this->validateRoute($route);

        $request = new WebRequestDTO(
            $_POST,
            $_GET,
            $route['action'] ?? '',
            $requestUri,
        );

        if ($this->configManager->isAuthEnabled()) {
            $this->auth->verifyAuth($requestUri);
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
