<?php

namespace App;

use Engine\Services\DBConnector\IDBConnection;
use PDOException;
use Psr\Log\LoggerInterface;

class HistoryProvider implements IHistoryProvider
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
                INSERT INTO `history` (`username`, `expression`, `date`) 
                VALUES (':username', ':expression', CURRENT_TIMESTAMP)
            SQL;

            $insertStmt = $pdo->prepare($insertSql);
            $insertStmt->bindParam(':username', $username);
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
