<?php

namespace Modules\User\Controllers;

interface IUserStorage
{
    public function addUser(string $username, string $passwordHash, string $role): void;

    public function getUserByName(string $username): ?array;

    public function getAllUsers(): array;

    public function isUserExist(string $username): bool;

    public function updateUser(string $oldUsername, string $username, string $passwordHash, string $role): void;

    public function deleteUser(string $username): void;
}
