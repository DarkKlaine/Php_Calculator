<?php

namespace App\DTO;

class Request
{
    private array $post;
    private array $get;
    private string $action;

    public function __construct(array $post, array $get, string $action)
    {
        $this->post = $post;
        $this->get = $get;
        $this->action = $action;
    }

    public function getPost(): array
    {
        return $this->post;
    }

    public function getGet(): array
    {
        return $this->get;
    }

    public function getAction(): string
    {
        return $this->action;
    }
}
