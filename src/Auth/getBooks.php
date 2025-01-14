<?php
// Incluir la clase de conexión a la base de datos
require_once('./src/Database/DBConnection.php');

// Crear una instancia de la conexión
$db = new \App\Database\DBConnection();
$conn = $db->getConnection();

// Consulta SQL para obtener todos los libros
$query = "SELECT * FROM books";
$stmt = $conn->prepare($query);

// Ejecutar la consulta
$stmt->execute();

// Obtener los resultados
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Devolver los resultados en formato JSON
echo json_encode($books);
?>
