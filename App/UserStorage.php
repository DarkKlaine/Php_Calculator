<?php

namespace App;

use Engine\Models\IAuthStorage;
use Engine\Services\DBConnector\IDBConnection;
use Modules\User\Controllers\IUserStorage;
use PDO;
use PDOException;
use Psr\Log\LoggerInterface;

class UserStorage implements IAuthStorage, IUserStorage
{
    private LoggerInterface $logger;
    private IDBConnection $connection;

    public function __construct(LoggerInterface $logger, IDBConnection $connection,)
    {
        $this->logger = $logger;
        $this->connection = $connection;
    }

    public function addUser(string $username, string $passwordHash, string $role): void
    {
        try {
            $pdo = $this->connection->getConnection();

            $pdo->beginTransaction();

            $sql = <<<SQL
                SELECT COUNT(*) 
                FROM `users` 
                WHERE `username` = :username
                FOR UPDATE
            SQL;

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $count = $stmt->fetchColumn();

            if ($count === 0) {
                $insertSql = <<<SQL
                    INSERT INTO `users` (`username`, `password_hash`, `role`) 
                    VALUES (:username, :passwordHash, :role)
                SQL;

                $insertStmt = $pdo->prepare($insertSql);
                $insertStmt->bindParam(':username', $username);
                $insertStmt->bindParam(':passwordHash', $passwordHash);
                $insertStmt->bindParam(':role', $role);
                $insertStmt->execute();

                $pdo->commit();
                $message = "Пользователь с именем $username успешно создан.";
            } else {
                $pdo->rollBack();
                $message = "Пользователь с именем $username уже существует.";
            }
            $this->logger->info($message);
        } catch (PDOException $e) {
            $pdo->rollBack();
            $error = 'Ошибка во время выполнения запроса к базе данных: ' . $e->getMessage();
            $this->logger->error($error);
        } finally {
            $stmt = null;
            $insertStmt = null;
            $this->connection->closeConnection();
        }
    }

    public function getUserByName(string $username): ?array
    {
        try {
            $pdo = $this->connection->getConnection();

            $sqlSelect = <<<SQL
                SELECT *
                FROM `users`
                WHERE `username` = :username
            SQL;

            $stmt = $pdo->prepare($sqlSelect);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $user[0] ?? null;
        } catch (PDOException $e) {
            $error = 'Ошибка во время выполнения запроса к базе данных: ' . $e->getMessage();
            $this->logger->error($error);
        } finally {
            $stmt = null;
            $this->connection->closeConnection();
        }

        return null;
    }

    public function getUserByID(string $userId): ?array
    {
        try {
            $pdo = $this->connection->getConnection();

            $sqlSelect = <<<SQL
                SELECT *
                FROM `users`
                WHERE `id` = :userId
            SQL;

            $stmt = $pdo->prepare($sqlSelect);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $user[0] ?? null;
        } catch (PDOException $e) {
            $error = 'Ошибка во время выполнения запроса к базе данных: ' . $e->getMessage();
            $this->logger->error($error);
        } finally {
            $stmt = null;
            $this->connection->closeConnection();
        }

        return null;
    }

    public function getAllUsers(): array
    {
        try {
            $pdo = $this->connection->getConnection();

            $sqlSelect = <<<SQL
                SELECT `username`, `role`, `date`
                FROM `users`
            SQL;

            $stmt = $pdo->prepare($sqlSelect);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $error = 'Ошибка во время выполнения запроса к базе данных: ' . $e->getMessage();
            $this->logger->error($error);
        } finally {
            $stmt = null;
            $this->connection->closeConnection();
        }

        return [];
    }

    public function isUserExist(string $username): bool
    {
        try {
            $pdo = $this->connection->getConnection();

            $sqlSelect = <<<SQL
                SELECT COUNT(*)
                FROM `users`
                WHERE `username` = :username
            SQL;

            $stmt = $pdo->prepare($sqlSelect);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $count = $stmt->fetchColumn();

            return $count > 0;
        } catch (PDOException $e) {
            $error = 'Ошибка во время выполнения запроса к базе данных: ' . $e->getMessage();
            $this->logger->error($error);
        } finally {
            $stmt = null;
            $this->connection->closeConnection();
        }

        return false;
    }

    public function updateUser(string $oldUsername, string $username, string $passwordHash, string $role): void
    {
        try {
            $pdo = $this->connection->getConnection();

            $pdo->beginTransaction();

            $sql = <<<SQL
                SELECT COUNT(*) 
                FROM `users` 
                WHERE `username` = :username
                FOR UPDATE
            SQL;

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $oldUsername);
            $stmt->execute();

            $count = $stmt->fetchColumn();

            if ($count > 0) {
                $newUsername = $username !== '' ? "`username` = :username, " : '';
                $newPasswordHash = $passwordHash !== '' ? "`password_hash` = :passwordHash, " : '';

                $updateSql = <<<SQL
                    UPDATE `users` 
                    SET $newUsername $newPasswordHash `role` = :role 
                    WHERE `username` = :oldUsername
                SQL;

                $updateStmt = $pdo->prepare($updateSql);
                if ($username !== '') {
                    $updateStmt->bindParam(':username', $username);
                }
                if ($passwordHash !== '') {
                    $updateStmt->bindParam(':passwordHash', $passwordHash);
                }
                $updateStmt->bindParam(':role', $role);
                $updateStmt->bindParam(':oldUsername', $oldUsername);
                $updateStmt->execute();

                $pdo->commit();
                $message = "Пользователь с именем $oldUsername успешно обновлен.";
            } else {
                $pdo->rollBack();
                $message = "Пользователя с именем $oldUsername не существует.";
            }
            $this->logger->info($message);
        } catch (PDOException $e) {
            $pdo->rollBack();
            $error = 'Ошибка во время выполнения запроса к базе данных: ' . $e->getMessage();
            $this->logger->error($error);
        } finally {
            $stmt = null;
            $updateStmt = null;
            $this->connection->closeConnection();
        }
    }

    public function deleteUser(string $username): void
    {
        try {
            $pdo = $this->connection->getConnection();

            $sql = <<<SQL
                DELETE FROM `users` 
                WHERE `username` = :username
            SQL;

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $message = "Пользователь с именем $username успешно удален.";
            $this->logger->info($message);
        } catch (PDOException $e) {
            $error = 'Ошибка во время выполнения запроса к базе данных: ' . $e->getMessage();
            $this->logger->error($error);
        } finally {
            $stmt = null;
            $this->connection->closeConnection();
        }
    }
}
