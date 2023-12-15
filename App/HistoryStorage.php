<?php

namespace App;

use Engine\Services\DBConnector\IDBConnection;
use Modules\Calculator\Models\HistoryModel\IHistoryStorage;
use PDO;
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

    public function addHistory(string $expression, string $userId): void
    {
        try {
            $pdo = $this->connection->getConnection();
            $pdo->beginTransaction();
            $sql = <<<SQL
                INSERT INTO `history` (`user_id`, `expression`) 
                VALUES (:userId, :expression)
            SQL;

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':expression', $expression);
            $stmt->execute();

            $pdo->commit();
        } catch (PDOException $e) {
            $this->logger->error("Ошибка во время выполнения запроса к базе данных: " . $e->getMessage());
        }
    }

    public function getUserHistory(int $userId): array
    {
        try {
            $pdo = $this->connection->getConnection();

            $sql = <<<SQL
                SELECT users.username, history.expression, history.date
                FROM history
                JOIN users ON history.user_id = users.id
                WHERE history.user_id = :userId;
            SQL;

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $error = 'Ошибка во время выполнения запроса к базе данных: ' . $e->getMessage();
            $this->logger->error($error);
        }

        return [];
    }

    public function getAllHistory(): array
    {
        try {
            $pdo = $this->connection->getConnection();
            $sql = <<<SQL
                SELECT users.username, history.expression, history.date
                FROM history
                LEFT JOIN users ON history.user_id = users.id
            SQL;

            $stmt = $pdo->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $error = 'Ошибка во время выполнения запроса к базе данных: ' . $e->getMessage();
            $this->logger->error($error);
        }

        return [];
    }
}
