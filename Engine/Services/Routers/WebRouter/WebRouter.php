<?php

namespace Engine\Services\Routers\WebRouter;

use Engine\IRouter;
use Engine\Services\ConfigManagers\IAuthConfigManagerWeb;
use Engine\Services\Container\Container;
use Engine\Services\Routers\AbstractRouter;
use Psr\Log\LoggerInterface;

class WebRouter extends AbstractRouter implements IRouter
{
    private IAuth $auth;
    private IAuthConfigManagerWeb $configManager;
    private IWebRedirectHandler $redirectHandler;

    public function __construct(
        LoggerInterface       $logger,
        IAuthConfigManagerWeb $configManager,
        IAuth                 $auth,
        Container             $container,
        IWebRedirectHandler   $redirectHandler,
    )
    {
        parent::__construct($logger, $container);
        $this->configManager = $configManager;
        $this->auth = $auth;
        $this->redirectHandler = $redirectHandler;
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
        );

        if ($this->configManager->isAuthEnabled()) {
            $this->auth->verifyAuth($requestUri);
        }

        $controllerName = $route['action'][0];
        $methodName = $route['action'][1];

        if (method_exists($controllerName, $methodName)) {
            $controller = $this->container->get($controllerName);
            $controller->$methodName($request);
        } else {
            $message = "Ошибка в WebRouter. Неправильный 'action' в *Routes.php.";
            $this->logger->error($message);
            echo $message;
            $this->redirectHandler->redirect($this->configManager->getHomeUrl());
        }
    }

    private function validateRoute(array $route): void
    {
        if (empty($route)) {
            $message = '404. Ошибка в WebRouter';
            $this->logger->debug($message);
            echo $message;
            $this->redirectHandler->redirect($this->configManager->getHomeUrl());
        }
    }
}
