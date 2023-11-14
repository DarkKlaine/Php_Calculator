<?php

namespace Engine\Router\WebRouter;

class WebRequestDTO
{
    private string $requestURL;
    private array $post;
    private array $get;
    private string $action;

    public function __construct(array $post, array $get, string $action, string $requestURL)
    {
        $this->post = $post;
        $this->get = $get;
        $this->action = $action;
        $this->requestURL = $requestURL;
    }

    public function getPost(): ?array
    {
        return $this->post ?? null;
    }

    public function getGet(): ?array
    {
        return $this->get ?? null;
    }

    public function getAction(): ?string
    {
        return $this->action ?? null;
    }

    public function getRequestURL(): ?string
    {
        return $this->requestURL ?? null;
    }
}
