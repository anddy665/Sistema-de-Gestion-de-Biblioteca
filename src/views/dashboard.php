<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .content-container {
            overflow-y: auto;
        }
    </style>
</head>

<body class="d-flex flex-column vh-100">
    <?php include __DIR__ . '/header.php'; ?>

    <!-- Contenedor principal -->
    <main class="container flex-grow-1 mt-4 content-container">
        <h2 class="text-center mb-4">Sistema de Gestión de Biblioteca</h2>

        <!-- Nav Tabs -->
        <ul class="nav nav-tabs" id="libraryTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="books-tab" data-bs-toggle="tab" data-bs-target="#books" type="button" role="tab" aria-controls="books" aria-selected="true">
                    Libros
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab" aria-controls="users" aria-selected="false">
                    Usuarios
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="loans-tab" data-bs-toggle="tab" data-bs-target="#loans" type="button" role="tab" aria-controls="loans" aria-selected="false">
                    Préstamos
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-3" id="libraryTabsContent">
            <!-- Books Tab -->
            <div class="tab-pane fade show active" id="books" role="tabpanel" aria-labelledby="books-tab">
                <h3 class="mb-3">Gestión de Libros</h3>
                <!-- Formulario o contenido relacionado con libros -->
                <p>Aquí puedes gestionar los libros (Crear, Leer, Actualizar, Eliminar).</p>
                <button class="btn btn-primary">Añadir Nuevo Libro</button>
            </div>

            <!-- Users Tab -->
            <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
                <h3 class="mb-3">Gestión de Usuarios</h3>
                <!-- Formulario o contenido relacionado con usuarios -->
                <p>Aquí puedes gestionar los usuarios registrados (Crear, Leer, Actualizar, Eliminar).</p>
                <button class="btn btn-primary">Añadir Nuevo Usuario</button>
            </div>

            <!-- Loans Tab -->
            <div class="tab-pane fade" id="loans" role="tabpanel" aria-labelledby="loans-tab">
                <h3 class="mb-3">Gestión de Préstamos</h3>
                <!-- Formulario o contenido relacionado con préstamos -->
                <p>Aquí puedes registrar y gestionar los préstamos de libros.</p>
                <button class="btn btn-primary">Registrar Préstamo</button>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-light text-center py-3">
        <p>&copy; 2025 Sistema de Gestión de Biblioteca. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/tabs.js"></script>
</body>

</html>

