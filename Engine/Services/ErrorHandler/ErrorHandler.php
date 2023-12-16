<?php

namespace Engine\Services\ErrorHandler;

use Engine\Views\Page403View;
use Engine\Views\Page404View;
use Engine\Views\Page500View;
use Error;
use Exception;
use Psr\Log\LoggerInterface;

class ErrorHandler
{
    private LoggerInterface $logger;
    private Page403View $page403View;
    private Page404View $page404View;
    private Page500View $page500View;

    public function __construct(
        LoggerInterface $logger,
        Page403View $page403View,
        Page404View $page404View,
        Page500View $page500View,
    ) {
        $this->logger = $logger;
        $this->page403View = $page403View;
        $this->page404View = $page404View;
        $this->page500View = $page500View;
    }

    public function handleE(Error | Exception $e): void
    {
        $errorCode = $e->getCode();

        $this->logger->error($e->getMessage());

        switch ($errorCode) {
            case 404:
                $this->redirectTo404Page();
                break;
            default:
                $this->redirectTo500Page();
                break;
        }
    }

    private function redirectTo404Page(): void
    {
        $this->page404View->render();
    }

    private function redirectTo500Page(): void
    {
        $this->page500View->render();
    }
}
