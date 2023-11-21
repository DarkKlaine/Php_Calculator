<?php

namespace Engine\Services\DBConnector;

use PDO;

interface IDBConnection
{
    public function getConnection(): ?PDO;

    public function closeConnection(): void;
}