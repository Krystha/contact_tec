<?php
$servername = "localhost";
$username = "root";
$password = ""; // Contraseña en blanco
$dbname = "contact_tec";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
