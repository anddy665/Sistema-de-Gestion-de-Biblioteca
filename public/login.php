<?php
require '../vendor/autoload.php';

use App\Auth\AuthController;

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new AuthController();
    $error = $auth->login($_POST['username'], $_POST['password']);
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-sm p-3" style="max-width: 400px; width: 100%;">
            <div class="card-header bg-warning text-white text-center">
                <h3 class="">Iniciar Sesión</h3>
            </div>
            <div class="card-body">
                <?php if ($error): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $error ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="username" name="username" required placeholder="Ingrese su usuario">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required placeholder="Ingrese su contraseña">
                    </div>
                    <button type="submit" class="btn btn-success w-100">Iniciar Sesión</button>
                </form>
            </div>
            <div class="card-footer text-center text-muted">
                &copy; 2025 Sistema de Gestión de Biblioteca
            </div>
        </div>
    </div>

    <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
