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

        $sqlInsert = "INSERT INTO `users` (`username`, `password_hash`, `role`) VALUES ('$username', '$passwordHash', '$role')";

        try {
            $connection->exec($sqlInsert);
        } catch (PDOException $e) {
            echo "Ошибка при создании записи: " . $e->getMessage();
            $this->logger->error("Ошибка при создании записи: " . $e->getMessage());
        }

        $this->connection->closeConnection();
    }

    public function getUserDataFromDB(string $username): array
    {
        $connection = $this->connection->getConnection();
        $sqlSelect = "SELECT `username`, `role`, `date` FROM `users` WHERE `username` = '$username'";

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
        }

        $this->connection->closeConnection();

        return $userData;
    }

    public function getAllUsersDataFromDB(): array
    {
        $connection = $this->connection->getConnection();
        $sqlSelect = "SELECT `username`, `role` FROM `users`";
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
        }

        $this->connection->closeConnection();

        return $userData;
    }

    public function isUsernameExist(string $username): bool
    {
        $connection = $this->connection->getConnection();
        $sqlSelect = "SELECT `username` FROM `users` WHERE `username` = '$username'";
        $userExist = false;

        try {
            $result = $connection->query($sqlSelect);
            $userExist = !empty($result->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            echo "Ошибка при получении записи: " . $e->getMessage();
            $this->logger->error("Ошибка при получении записи: " . $e->getMessage());
        }

        $this->connection->closeConnection();

        return $userExist;
    }

    public function EditUserInDB($request): void
    {
        $connection = $this->connection->getConnection();
        $currentUsername = $request->getPost()['currentUsername'] ?? '';
        $username = $request->getPost()['username'] ?? '';

        $passwordHash = $request->getPost()['password'] ?? '';

        $role = $request->getPost()['role'] ?? '';

        $setUsername = '';
        if ($username !== '') {
            $setUsername = "`username` = '$username', ";
        }

        $setPasswordHash = '';
        if ($passwordHash !== '') {
            $setPasswordHash = "`password_hash` = '$passwordHash', ";
        }

        $sqlUpdate = "UPDATE `users` SET " . $setUsername . $setPasswordHash . "`role` = '$role' WHERE `username` = '$currentUsername'";

        try {
            $connection->exec($sqlUpdate);
        } catch (PDOException $e) {
            echo "Ошибка при обновлении записи: " . $e->getMessage();
            $this->logger->error("Ошибка при обновлении записи: " . $e->getMessage());
        }

        $this->connection->closeConnection();
    }

    public function deleteUserFromDB(string $username): void
    {
        $connection = $this->connection->getConnection();

        $sqlDelete = "DELETE FROM `users` WHERE `username` = '$username'";

        try {
            $connection->exec($sqlDelete);
        } catch (PDOException $e) {
            echo "Ошибка при удалении записи: " . $e->getMessage();
            $this->logger->error("Ошибка при удалении записи: " . $e->getMessage());
        }

        $this->connection->closeConnection();
    }
}
