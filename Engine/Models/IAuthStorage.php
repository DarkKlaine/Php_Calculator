<?php

namespace Engine\Models;

interface IAuthStorage
{
    public function getUserByName(string $username): ?array;
    public function getUserByID(string $userId): ?array;
}
