<?php
session_start();

// Verifica que el usuario esté logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

include('includes\conexion.php'); // Incluye la conexión a la base de datos

// Verifica si se ha proporcionado un ID de usuario
if (!isset($_GET['id'])) {
    header("Location: usuarios.php"); // Redirige si no se proporciona ID
    exit();
}

$id = $_GET['id'];

// Elimina el usuario de la base de datos
$sql = "DELETE FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Usuario eliminado exitosamente.";
    header("Location: usuarios.php"); // Redirige al listado de usuarios
    exit();
} else {
    echo "Error: " . $stmt->error;
}
?>
