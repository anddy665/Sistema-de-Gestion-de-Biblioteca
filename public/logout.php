<?php
require '../vendor/autoload.php';

use App\Auth\Session;

Session::destroy();

header("Location: /Sistema-de-Gestion-de-Biblioteca/public/login.php");
exit;
