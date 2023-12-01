<?php

namespace Engine\Services\DBConnector;

use PDO;
use PDOException;
use Psr\Log\LoggerInterface;

class DBConnection implements IDBConnection
{
    private ?PDO $connection = null;

    public function __construct(
        LoggerInterface $logger,
        string $host,
        string $username,
        string $password,
        string $dbname
    ) {
        $dsn = "mysql:host={$host};dbname={$dbname}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->connection = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            $logger->error("Ошибка подключения: " . $e->getMessage());
            die();
        }
    }

    public function getConnection(): ?PDO
    {
        return $this->connection;
    }

    public function closeConnection(): void
    {
        $this->connection = null;
    }
}
