<?php
require '../vendor/autoload.php';




use App\Auth\Session;

Session::start();

if (!Session::get('admin_id')) {
    header("Location: /Sistema-de-Gestion-de-Biblioteca/public/login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Bienvenido al Sistema de Gestión de Biblioteca</h1>
        
        <div class="mt-4 text-center">
            <a href="/Sistema-de-Gestion-de-Biblioteca/public/logout.php" class="btn btn-danger">Cerrar sesión</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>