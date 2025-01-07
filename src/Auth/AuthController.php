<?php

namespace App\Auth;

use App\Models\Admin;

class AuthController
{
    public function login($username, $password)
    {

        error_log("Intento de inicio de sesión con el usuario: $username");

        $admin = (new Admin())->findByUsername($username);

        if (!$admin) {
            error_log("No se encontró el usuario: $username");
            return "-Usuario o contraseña inválidos.";
        }

        $password_check = password_verify(trim($password), $admin['password']);

        error_log("Contraseña verificada: " . ($password_check ? "Correcta" : "Incorrecta"));

        if ($admin && $password_check) {
            Session::start();
            Session::set('admin_id', $admin['id']);
            header("Location: /Sistema-de-Gestion-de-Biblioteca/public/index.php");
            exit;
        }

        return "Usuario o contraseña inválidos.";
    }
}
