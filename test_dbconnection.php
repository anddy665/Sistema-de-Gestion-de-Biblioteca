<?php
require './vendor/autoload.php'; 

use App\Database\DBConnection;

try {
    // Instance of the DBConnection class
    $db = new DBConnection();
    $connection = $db->connect();

    // Test a query
    $stmt = $connection->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Display the found tables
    echo "Connection successful. Tables in the database:<br>";
    foreach ($tables as $table) {
        echo "- $table<br>";
    }
} catch (PDOException $e) {
    // Error handling
    echo "Connection error: " . $e->getMessage();
}
