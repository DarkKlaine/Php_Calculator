<?php

namespace Engine\Services\DBConnector;

use PDO;
use PDOException;

class DBConnection
{
    private ?PDO $connection = null;

    public function __construct(string $host, string $username, string $password, string $dbname)
    {
        $dsn = "mysql:host={$host};dbname={$dbname}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->connection = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            die("Ошибка подключения: " . $e->getMessage());
        }
    }

    public function getConnection(): ?PDO
    {
        return $this->connection;
    }

    public function closeConnection(): void
    {
        $this->connection = null;
        echo "Соединение закрыто." . PHP_EOL;
    }
}