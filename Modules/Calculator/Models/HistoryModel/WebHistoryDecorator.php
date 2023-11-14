<?php

namespace Modules\Calculator\Models\HistoryModel;

class WebHistoryDecorator implements IHistoryDecorator
{
    private HistoryModel $historyModel;

    public function __construct(HistoryModel $historyModel)
    {
        $this->historyModel = $historyModel;
    }

    public function addToHistory(string $input, string $result): void
    {
        $this->historyModel->addToHistory($input, $result, true);
    }
}