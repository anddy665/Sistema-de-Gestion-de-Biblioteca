<?php
require '../vendor/autoload.php';

use App\Auth\Session;

Session::start();

if (!Session::get('admin_id')) {
    header("Location: /Sistema-de-Gestion-de-Biblioteca/public/login.php");
    exit;
}

include '../src/views/dashboard.php';