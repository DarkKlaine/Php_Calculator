<?php

namespace Engine\Services\Routers\WebRouter;

use Engine\IRouter;
use Engine\Services\ConfigManagers\IAuthConfigManagerWeb;
use Engine\Services\Container\Container;
use Engine\Services\ErrorHandler\ErrorHandler;
use Engine\Services\RedirectHandler\IWebRedirectHandler;
use Engine\Services\Routers\AbstractRouter;
use Error;
use Exception;
use Psr\Log\LoggerInterface;

class WebRouter extends AbstractRouter implements IRouter
{
    private IAuth $auth;
    private IAuthConfigManagerWeb $configManager;
    private IWebRedirectHandler $redirectHandler;
    private ErrorHandler $errorHandler;
    private const MARK = '/?';

    public function __construct(
        LoggerInterface $logger,
        IAuthConfigManagerWeb $configManager,
        IAuth $auth,
        Container $container,
        IWebRedirectHandler $redirectHandler,
        ErrorHandler $errorHandler
    ) {
        parent::__construct($logger, $container);
        $this->configManager = $configManager;
        $this->auth = $auth;
        $this->redirectHandler = $redirectHandler;
        $this->errorHandler = $errorHandler;
    }

    public function run(): void
    {
        try {
            $this->handleRequest();
        } catch (Error | Exception $e) {
            $this->errorHandler->handleE($e);
        }
    }

    /**
     * @throws Exception
     */
    private function handleRequest(): void
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        if (str_contains($requestUri, self::MARK)) {
            $requestUri = strstr($requestUri, self::MARK, true);
        }

        $routes = $this->configManager->getRoutes();
        $route = [];

        foreach ($routes as $key => $value) {
            if ($value['url'] === $requestUri) {
                $route = $value;
                break;
            }
        }

        if ($this->configManager->isAuthEnabled()) {
            $this->auth->verifyAuth($requestUri);
        }

        $className = $route['action'][0] ?? '';
        $methodName = $route['action'][1] ?? '';
        $request = new WebRequestDTO($_POST, $_GET,);

        if (method_exists($className, $methodName)) {
            $controller = $this->container->get($className);
            $controller->$methodName($request);
        } else {
            throw new Exception("Ошибка в WebRouter. Неправильный 'action' в *Routes.php.", '404');
        }
    }
}
