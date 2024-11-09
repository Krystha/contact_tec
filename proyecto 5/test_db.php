<?php
$host = 'localhost';
$dbname = 'usuario'; // Nombre correcto de la base de datos
$username = 'root'; // Usuario por defecto
$password = ''; // Sin contraseña por defecto

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    die("No se pudo conectar a la base de datos: " . $e->getMessage());
}
?>
