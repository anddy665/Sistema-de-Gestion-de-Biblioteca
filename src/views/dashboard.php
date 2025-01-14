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
    
    <!-- Add New Book Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addBookModal">Add New Book</button>
    
    <!-- Books List Table -->
    <div class="book-list mt-3">
        <h4 class="mb-3">Books List</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Publication Year</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="bookListTableBody">
                <!-- Book list rows will be dynamically loaded here -->
            </tbody>
        </table>
    </div>

    <!-- Add Book Modal -->
    <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addBookModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addBookForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBookModalLabel">Add New Book</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" class="form-control" id="author" name="author" required>
                        </div>
                        <div class="mb-3">
                            <label for="genre" class="form-label">Genre</label>
                            <input type="text" class="form-control" id="genre" name="genre" required>
                        </div>
                        <div class="mb-3">
                            <label for="publicationYear" class="form-label">Publication Year</label>
                            <input type="number" class="form-control" id="publicationYear" name="publication_year" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Available">Available</option>
                                <option value="Borrowed">Borrowed</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


            <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
                <h3 class="mb-3">User Management</h3>
                <?php include 'edit-user-modal.php'; ?>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Add New User</button>
                <div class="user-list mt-3">
                    <h4 class="mb-3">Users List</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="userListTableBody">
                        </tbody>
                        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form id="addUserForm">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="fullName" class="form-label">Full Name</label>
                                                <input type="text" class="form-control" id="fullName" name="full_name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="phoneNumber" class="form-label">Phone Number</label>
                                                <input type="text" class="form-control" id="phoneNumber" name="phone_number">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Add User</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </table>
                </div>
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
    <script src="/Sistema-de-Gestion-de-Biblioteca/js/tabs.js"></script>
    <script src="/Sistema-de-Gestion-de-Biblioteca/js/loadUsers.js"></script>
    <script src="/Sistema-de-Gestion-de-Biblioteca/js/loadBooks.js"></script>
    <script src="/Sistema-de-Gestion-de-Biblioteca/js/addUser.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/Sistema-de-Gestion-de-Biblioteca/js/editUser.js"></script>
    <script src="/Sistema-de-Gestion-de-Biblioteca/js/deleteUser.js"></script>
</body>

</html>