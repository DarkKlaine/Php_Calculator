<?php

namespace App\Models;

use App\Application;

class AuthModel
{
    private array $users;

    public function __construct()
    {
        $this->users = require_once('../Config/users.php');
    }

    public function auth(): void
    {
        if ($_POST) {
            $_SESSION['loginInfo'] = [$_POST['username'] => $_POST['password']];
        }

        if (isset($_SESSION['loginInfo']) === false) {
            return;
        }

        if (!empty(array_intersect_assoc($this->users, $_SESSION['loginInfo']))) {
            $_SESSION['authorized'] = true;
            $_SESSION['loginTimestamp'] = time();
            header("Location: " . Application::$homeUrl);
            exit;
        }
    }
}