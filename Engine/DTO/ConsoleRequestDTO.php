<?php

namespace Engine\DTO;

class ConsoleRequestDTO
{
    private array $inputData;
    private string $action;

    public function __construct(array $inputData, string $action)
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
