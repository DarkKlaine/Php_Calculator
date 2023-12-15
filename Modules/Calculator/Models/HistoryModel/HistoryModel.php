<?php

namespace Modules\Calculator\Models\HistoryModel;

use Engine\Services\DBConnector\IDBConnection;
use PDO;
use PDOException;
use Psr\Log\LoggerInterface;

class HistoryModel
{
    private string $logDir = __DIR__ . '/../../../../Log';
    private string $logFile = __DIR__ . '/../../../../Log/History.Log';
    private int $maxLogSize = 10;
    private IDBConnection $dbConnection;
    private LoggerInterface $logger;
    private IHistoryStorage $historyStorage;

    public function __construct(IDBConnection $dbConnection, LoggerInterface $logger, IHistoryStorage $historyStorage)
    {
        $this->dbConnection = $dbConnection;
        $this->logger = $logger;
        $this->historyStorage = $historyStorage;
    }

    public function addToHistory(string $input, string $result, bool $needSessionHistory): void
    {
        if (is_numeric($result) === false) {
            return;
        }

        // Формирование строки для логирования
        $input = str_replace(' ', '', $input);
        $stringForLogging = $input . ' = ' . $result . ' | ' . date('Y-m-d H:i:s') . PHP_EOL;
        $id = $_SESSION['userID'] ?? '0';
        // Добавление строки в глобальный лог
        $this->addToGlobalHistory($stringForLogging);
        // Добавление строки в базу данных
        $this->historyStorage->addHistory($input . ' = ' . $result, $id);
        // Добавление строки в лог сессии (если необходимо)
        if ($needSessionHistory) {
            $this->addToSessionHistory($stringForLogging);
        }
    }

    private function addToGlobalHistory(string $stringForLogging): void
    {
        if (is_dir($this->logDir) === false) {
            mkdir($this->logDir);
        }

        $logArray = file($this->logFile) ?? [];

        $logArray = $this->processLogArray($logArray, $stringForLogging);

        file_put_contents($this->logFile, implode("", $logArray));
    }

    private function processLogArray(array $logArray, string $stringForLogging): array
    {
        $logArray = $this->trimToMaxSize($logArray);
        $logArray[] = $stringForLogging;

        return $this->numberingAndPadding($logArray);
    }

    private function trimToMaxSize(array $logArray): array
    {
        $maxLogSize = $this->maxLogSize - 1;
        $logSize = count($logArray);

        if ($logSize > $maxLogSize) {
            array_splice($logArray, 0, $logSize - $maxLogSize);
        }

        return preg_replace('/[ 1-9][0-9]: +/', '', $logArray);
    }

    private function numberingAndPadding(array $logArray): array
    {
        $longestStr = 0;
        foreach ($logArray as $value) {
            $lengthStr = strlen($value);
            if ($lengthStr > $longestStr) {
                $longestStr = $lengthStr;
            }
        }

        foreach ($logArray as $key => &$value) {
            $number = $key < 9 ? ' ' . ($key + 1) : ($key + 1);
            $value = $number . ': ' . str_pad($value, $longestStr, ' ', STR_PAD_LEFT);
        }
        unset($value);

        return $logArray;
    }

    private function addToSessionHistory(string $stringForLogging): void
    {
        $logArray = $_SESSION['history'] ?? [];

        $logArray = $this->processLogArray($logArray, $stringForLogging);

        $_SESSION['history'] = $logArray;
    }

    public function getGeneralHistoryString(bool $isForWeb): string
    {
        $logArray = file($this->logFile) ?? [];

        return $this->generateHistoryString($logArray, $isForWeb);
    }

    private function generateHistoryString(array $logArray, bool $isForWeb): string
    {
        $historyString = '';

        for ($i = 0; $i < count($logArray); $i++) {
            $historyString .= $logArray[$i];
        }

        if ($isForWeb) {
            $historyString = str_replace(' ', '&nbsp', $historyString);
            $historyString = str_replace(PHP_EOL, '<br>', $historyString);
        }

        return $historyString;
    }

    public function getSessionHistoryString(bool $isForWeb): string
    {
        $logArray = $_SESSION['history'] ?? [];

        return $this->generateHistoryString($logArray, $isForWeb);
    }

    public function getDBHistoryString(bool $isForWeb): string
    {
        $connection = $this->dbConnection->getConnection();
        $sqlSelect = "SELECT `expression`, `date` FROM `history` ORDER BY `date` DESC LIMIT 10";
        $result = $connection->query($sqlSelect);
        $logArray = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $expression = $row["expression"];
            $date = $row["date"];
            array_unshift($logArray, $expression . ' | ' . $date . PHP_EOL);
        }

        $this->dbConnection->closeConnection();

        $logArray = $this->numberingAndPadding($logArray);

        return $this->generateHistoryString($logArray, $isForWeb);
    }

    public function getAllHistory(): array
    {
        return $this->historyStorage->getAllHistory();
    }

    public function getUserHistory(): array
    {
        $id = $_SESSION['userID'] ?? 0;
        return $this->historyStorage->getUserHistory($id);
    }
}
