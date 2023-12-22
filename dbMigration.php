<?php
// Параметры подключения
$servername = "mysql";
$username = "root";
$password = "root";
$database = "dkdb";

try {
    // Подключение к MySQL
    $connection = new PDO("mysql:host=$servername", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Создание бд
    $sql = "CREATE DATABASE IF NOT EXISTS $database";
    $connection->exec($sql);
    echo "База данных успешно создана";

    // Подключение к созданной базе данных
    $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Создание users
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username TEXT(30) NOT NULL,
        role TEXT(50) NOT NULL,
        password_hash TEXT(255) NOT NULL,
        date DATETIME default CURRENT_TIMESTAMP,
        UNIQUE (username)
    )";
    $connection->exec($sql);
    echo "Таблица 'users' успешно создана";

    // Создание history
    $sql = "CREATE TABLE IF NOT EXISTS history (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT(6) UNSIGNED,
        expression VARCHAR(255) NOT NULL,
        date DATETIME default CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )";
    $connection->exec($sql);
    echo "Таблица 'history' успешно создана";

    // Создание пользователя
    $username = 'admin';
    $hashedPassword = password_hash("admin", PASSWORD_DEFAULT);
    $role = "Администратор";
    $sql = "INSERT IGNORE INTO users (username, role, password_hash) VALUES ('$username', '$role', '$hashedPassword')";
    $connection->exec($sql);
    echo "Пользователь 'admin' успешно создан";

} catch(PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}

$connection = null;
