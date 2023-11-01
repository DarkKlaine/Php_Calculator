<?php

namespace App\Models;

use App\Application;

class AuthModel
{
    private array $users;

    public function __construct()
    {
        $this->users = require('../Config/users.php');
    }

    public function auth(): void
    {
        if (!empty(array_intersect_assoc($this->users, $_SESSION['loginInfo']))) {
            $_SESSION['authorized'] = true;
            $_SESSION['loginTimestamp'] = time();
            header("Location: " . Application::$homeUrl);
            exit;
        }
    }
}
