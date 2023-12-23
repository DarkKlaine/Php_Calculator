<?php

namespace Modules\Calculator\Models\HistoryModel;

use Engine\Models\IAuthSessionHandler;

class HistoryModel
{
    private IHistoryStorage $historyStorage;
    private IAuthSessionHandler $authSessionHandler;

    public function __construct(IAuthSessionHandler $authSessionHandler, IHistoryStorage $historyStorage)
    {
        $this->historyStorage = $historyStorage;
        $this->authSessionHandler = $authSessionHandler;
    }

    public function addToHistory(string $input, string $result): void
    {
        if (is_numeric($result) === false) {
            return;
        }

        $input = str_replace(' ', '', $input);
        $id = $this->authSessionHandler->getUserID();

        $this->historyStorage->addToHistory($input . ' = ' . $result, $id);
    }

    public function getAllHistory(): array
    {
        return $this->historyStorage->getAllHistory();
    }

    public function getUserHistory(): array
    {
        $id = $this->authSessionHandler->getUserID();
        return $this->historyStorage->getUserHistory($id);
    }
}
