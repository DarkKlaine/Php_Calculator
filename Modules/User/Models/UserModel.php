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
        $username = $request->getPost()['username'] ?? '';
        $passwordHash = $request->getPost()['password'] ?? '';
        $role = $request->getPost()['role'] ?? '';

        $sqlInsert = <<<SQL
            INSERT INTO `users` (`username`, `password_hash`, `role`)
            VALUES ('$username', '$passwordHash', '$role')
        SQL;

        $this->executeQuery($sqlInsert);
    }

    public function getUserDataFromDB(string $username): array
    {
        $sqlSelect = <<<SQL
            SELECT `username`, `role`, `date`
            FROM `users`
            WHERE `username` = '$username'
        SQL;

        $data = $this->executeQuery($sqlSelect, true);

        return [
            'username' => $data[0]['username'],
            'role' => $data[0]['role'],
            'date' => $data[0]['date']
        ];
    }

    public function getAllUsersDataFromDB(): array
    {
        $sqlSelect = <<<SQL
            SELECT `username`, `role` 
            FROM `users`
        SQL;

        return $this->executeQuery($sqlSelect, true);
    }

    public function isUsernameExist(string $username): bool
    {
        $sqlSelect = <<<SQL
            SELECT `username` 
            FROM `users` 
            WHERE `username` = '$username'
        SQL;

        $data = $this->executeQuery($sqlSelect, true);

        return !empty($data);
    }

    public function updateUserInDB(WebRequestDTO $request): void
    {
        $currentUsername = $request->getPost()['currentUsername'] ?? null;
        $username = $request->getPost()['username'] ?? null;
        $passwordHash = $request->getPost()['password'] ?? null;
        $role = $request->getPost()['role'] ?? null;

        $newUsername = $username !== '' ? "`username` = '$username', " : '';
        $newPasswordHash = $passwordHash !== '' ? "`password_hash` = '$passwordHash', " : '';

        $sqlUpdate = <<<SQL
            UPDATE `users`
            SET $newUsername $newPasswordHash `role` = '$role'
            WHERE `username` = '$currentUsername'
        SQL;

        $this->executeQuery($sqlUpdate);
    }

    public function deleteUserFromDB(string $username): void
    {
        $sqlDelete = <<<SQL
            DELETE FROM `users` 
            WHERE `username` = '$username'
        SQL;

        $this->executeQuery($sqlDelete);
    }

    private function executeQuery(string $sqlQuery, bool $isSelectQuery = false): ?array
    {
        $data = null;
        try {
            $connection = $this->connection->getConnection();

            if ($isSelectQuery) {
                $result = $connection->query($sqlQuery);
                $data = [];
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }
            } else {
                $connection->exec($sqlQuery);
            }
        } catch (PDOException $e) {
            $message = 'Ошибка во время выполнения запроса к базе данных: ' . $e->getMessage();
            echo $message;
            $this->logger->error($message);
        } finally {
            $this->connection->closeConnection();
        }

        return $data;
    }
}
