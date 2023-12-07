<?php

namespace Engine\Services\Routers\WebRouter;

class WebRequestDTO
{
    private array $post;
    private array $get;

    public function __construct(array $post, array $get)
    {
        $this->post = $post;
        $this->get = $get;
    }

    public function getPost(?string ...$keys): mixed
    {
        $value = $this->post;

        foreach ($keys as $key) {
            $value = $value[$key] ?? null;

            if ($value === null) {
                break;
            }
        }

        return $value;
    }

    public function getGet(?string ...$keys): mixed
    {
        $value = $this->get;

        foreach ($keys as $key) {
            $value = $value[$key] ?? null;

            if ($value === null) {
                break;
            }
        }

        return $value;
    }
}
