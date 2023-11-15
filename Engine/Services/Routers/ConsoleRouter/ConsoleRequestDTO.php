<?php

namespace Engine\Services\Routers\ConsoleRouter;

class ConsoleRequestDTO
{
    private array $inputData;
    private string $action;

    public function __construct(string $action, array $inputData,)
    {
        $this->action = $action;
        $this->inputData = $inputData;
    }

    public function getInputData(): array
    {
        return $this->inputData;
    }

    public function getAction(): string
    {
        return $this->action;
    }
}
