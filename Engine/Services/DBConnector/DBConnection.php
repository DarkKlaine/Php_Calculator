<?php

namespace Engine\Services\DBConnector;

use PDO;
use PDOException;

class DBConnection
{
    private string $servername = "localhost";
    private string $username = "root";
    private string $password = "pass";
    private string $dbname = "history";
    private ?PDO $connection = null;

    public function __construct()
    {
        $dsn = "mysql:host={$this->servername};dbname={$this->dbname}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->connection = new PDO($dsn, $this->username, $this->password, $options);
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