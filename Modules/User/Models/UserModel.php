<?php

namespace Modules\User\Models;

use Engine\Services\DBConnector\IDBConnection;
use Engine\Services\Routers\WebRouter\WebRequestDTO;
use PDO;
use PDOException;
use Psr\Log\LoggerInterface;

class UserModel
{
    private LoggerInterface $logger;
    private IDBConnection $connection;

    public function __construct(LoggerInterface $logger, IDBConnection $connection,)
    {
        $this->logger = $logger;
        $this->connection = $connection;
    }

    public function addUserToDB(WebRequestDTO $request): void
    {
        $connection = $this->connection->getConnection();
        $username = $request->getPost()['username'] ?? '';
        $passwordHash = $request->getPost()['password'] ?? '';
        $role = $request->getPost()['role'] ?? '';

        $sqlInsert = <<<SQL
            INSERT INTO `users` (`username`, `password_hash`, `role`)
            VALUES ('$username', '$passwordHash', '$role')
        SQL;

        try {
            $connection->exec($sqlInsert);
        } catch (PDOException $e) {
            echo "Ошибка при создании записи: " . $e->getMessage();
            $this->logger->error("Ошибка при создании записи: " . $e->getMessage());
        } finally {
            $this->connection->closeConnection();
        }
    }
    public function getUserDataFromDB(string $username): array
    {
        $connection = $this->connection->getConnection();

        $sqlSelect = <<<SQL
            SELECT `username`, `role`, `date`
            FROM `users`
            WHERE `username` = '$username'
        SQL;

        $userData = [];

        try {
            $result = $connection->query($sqlSelect);

            if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $username = $row['username'];
                $role = $row['role'];
                $date = $row['date'];

                $userData = ['username' => $username, 'role' => $role, 'date' => $date];
            }
        } catch (PDOException $e) {
            echo "Ошибка при получении записи: " . $e->getMessage();
            $this->logger->error("Ошибка при получении записи: " . $e->getMessage());
        } finally {
            $this->connection->closeConnection();
        }

        return $userData;
    }

    public function getAllUsersDataFromDB(): array
    {
        $connection = $this->connection->getConnection();

        $sqlSelect =  <<<SQL
            SELECT `username`, `role` 
            FROM `users`
        SQL;

        $userData = [];

        try {
            $result = $connection->query($sqlSelect);

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $username = $row['username'];
                $role = $row['role'];

                $userData[] = ['username' => $username, 'role' => $role];
            }
        } catch (PDOException $e) {
            echo "Ошибка при получении записи: " . $e->getMessage();
            $this->logger->error("Ошибка при получении записи: " . $e->getMessage());
        } finally {
            $this->connection->closeConnection();
        }

        return $userData;
    }

    public function isUsernameExist(string $username): bool
    {
        $connection = $this->connection->getConnection();

        $sqlSelect = <<<SQL
            SELECT `username` 
            FROM `users` 
            WHERE `username` = '$username'
        SQL;

        $userExist = false;

        try {
            $result = $connection->query($sqlSelect);
            $userExist = !empty($result->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            echo "Ошибка при получении записи: " . $e->getMessage();
            $this->logger->error("Ошибка при получении записи: " . $e->getMessage());
        } finally {
            $this->connection->closeConnection();
        }

        return $userExist;
    }

    public function updateUserInDB($request): void
    {
        $connection = $this->connection->getConnection();

        $currentUsername = $request->getPost()['currentUsername'] ?? null;
        $username = $request->getPost()['username'] ?? null;
        $passwordHash = $request->getPost()['password'] ?? null;
        $role = $request->getPost()['role'] ?? null;

        $setUsername = $username !== '' ? "`username` = '$username', " : '';
        $setPasswordHash = $passwordHash !== '' ? "`password_hash` = '$passwordHash', " : '';

        $sqlUpdate = <<<SQL
            UPDATE `users`
            SET $setUsername $setPasswordHash `role` = '$role'
            WHERE `username` = '$currentUsername'
        SQL;

        try {
            $connection->exec($sqlUpdate);
        } catch (PDOException $e) {
            echo "Ошибка при обновлении записи: " . $e->getMessage();
            $this->logger->error("Ошибка при обновлении записи: " . $e->getMessage());
        } finally {
            $this->connection->closeConnection();
        }
    }

    public function deleteUserFromDB(string $username): void
    {
        $connection = $this->connection->getConnection();

        $sqlDelete = <<<SQL
            DELETE FROM `users` 
            WHERE `username` = '$username'
        SQL;

        try {
            $connection->exec($sqlDelete);
        } catch (PDOException $e) {
            echo "Ошибка при удалении записи: " . $e->getMessage();
            $this->logger->error("Ошибка при удалении записи: " . $e->getMessage());
        } finally {
            $this->connection->closeConnection();
        }
    }
}
