<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .content-container {
            overflow-y: auto;
        }
    </style>
</head>

<body class="d-flex flex-column vh-100">
    <?php include __DIR__ . '/header.php'; ?>


    <main class="container flex-grow-1 mt-4 content-container">
        <h2 class="text-center mb-4">Library Management System</h2>


        <ul class="nav nav-tabs" id="libraryTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="books-tab" data-bs-toggle="tab" data-bs-target="#books" type="button" role="tab" aria-controls="books" aria-selected="true">
                    Books
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab" aria-controls="users" aria-selected="false">
                    Users
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="loans-tab" data-bs-toggle="tab" data-bs-target="#loans" type="button" role="tab" aria-controls="loans" aria-selected="false">
                    Loans
                </button>
            </li>
        </ul>


        <div class="tab-content mt-3" id="libraryTabsContent">

            <div class="tab-pane fade show active" id="books" role="tabpanel" aria-labelledby="books-tab">
                <h3 class="mb-3">Library Management</h3>

                <p>Aquí puedes gestionar los libros (Crear, Leer, Actualizar, Eliminar).</p>
                <button class="btn btn-primary">Add New Book</button>
            </div>


            <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
                <h3 class="mb-3">User Management</h3>

                <p>Aquí puedes gestionar los usuarios registrados (Crear, Leer, Actualizar, Eliminar).</p>
                <button class="btn btn-primary">Add New User</button>
            </div>


            <div class="tab-pane fade" id="loans" role="tabpanel" aria-labelledby="loans-tab">
                <h3 class="mb-3">Loan Management</h3>

                <p>Aquí puedes registrar y gestionar los préstamos de libros.</p>
                <button class="btn btn-primary">Register Loan</button>
            </div>
        </div>
    </main>


    <footer class="bg-light text-center py-3">
        <p>&copy;2025 Library Management System. All rights reserved SMBS.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/tabs.js"></script>
</body>

</html>