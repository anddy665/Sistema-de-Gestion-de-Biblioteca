<?php
require_once '../src/Database/DBConnection.php';
require_once '../src/Models/User.php';
require_once '../src/Auth/UserController.php';

use App\Database\DBConnection;
$dbConnection = new DBConnection();
$userController = new \App\Controller\UserController($dbConnection);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'create') {
        $fullName = $_POST['full_name'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phone_number'];
        $userController->create($fullName, $email, $phoneNumber);
        header("Location: index.php#users");
        exit();
    }
}
