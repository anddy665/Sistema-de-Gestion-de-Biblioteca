<?php

namespace App\Auth;

use App\Models\Admin;

class AuthController
{
    public function login($username, $password)
    {

        $admin = (new Admin())->findByUsername($username);

        if (!$admin) {

            return "Invalid username or password.";
        }

        $password_check = password_verify(trim($password), $admin['password']);

        if ($admin && $password_check) {
            Session::start();
            Session::set('admin_id', $admin['id']);
            header("Location: /Sistema-de-Gestion-de-Biblioteca/public/index.php");
            exit;
        }

        return "Invalid username or password.";
    }
}
