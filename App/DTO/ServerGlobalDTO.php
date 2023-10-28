<?php

namespace App\DTO;

class ServerGlobalDTO
{
    private array $post;
    private array $get;

    public function __construct(array $post, array $get)
    {
        $this->post = $post;
        $this->get = $get;
    }

    public function getPost(): array
    {
        return $this->post;
    }

    public function getGet(): array
    {
        return $this->get;
    }
}