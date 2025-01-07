<?php

namespace App\Auth;

use App\Models\Admin;

class AuthController
{
    public function login($username, $password)
    {
        error_log("Login attempt with username: $username");

        $admin = (new Admin())->findByUsername($username);

        if (!$admin) {
            error_log("User not found: $username");
            return "Invalid username or password.";
        }

        $password_check = password_verify(trim($password), $admin['password']);

        error_log("Password verification: " . ($password_check ? "Correct" : "Incorrect"));

        if ($admin && $password_check) {
            Session::start();
            Session::set('admin_id', $admin['id']);
            header("Location: /Sistema-de-Gestion-de-Biblioteca/public/index.php");
            exit;
        }

        return "Invalid username or password.";
    }
}

