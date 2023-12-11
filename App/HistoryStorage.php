<?php

namespace App;

use Engine\Services\DBConnector\IDBConnection;
use Modules\Calculator\Models\HistoryModel\IHistoryStorage;
use PDOException;
use Psr\Log\LoggerInterface;

class HistoryStorage implements IHistoryStorage
{
    private LoggerInterface $logger;
    private IDBConnection $connection;

    public function __construct(LoggerInterface $logger, IDBConnection $connection,)
    {
        $this->logger = $logger;
        $this->connection = $connection;
    }

    public function addHistory(string $expression, string $username): void
    {
        try {
            $pdo = $this->connection->getConnection();
            $insertSql = <<<SQL
                INSERT INTO `history` (`user_id`, `expression`, `date`) 
                VALUES (':userID', ':expression', CURRENT_TIMESTAMP)
            SQL;

            $insertStmt = $pdo->prepare($insertSql);
            $insertStmt->bindParam(':userID', $username);
            $insertStmt->bindParam(':expression', $expression);
            $insertStmt->execute();

            $pdo->commit();
        } catch (PDOException $e) {
            $this->logger->error("Ошибка при создании записи: " . $e->getMessage());
        }

        $this->connection->closeConnection();
    }

    public function getUserHistory(string $username): ?array
    {
        return [];
    }

    public function getAllHistory(): array
    {
        return [];
    }
}
