<?php

namespace Engine\Models;

interface IAuthStorage
{
    public function getUser(string $username): ?array;
}
