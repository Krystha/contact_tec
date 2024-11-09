<?php
session_start();

// Verifica que el usuario esté logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

include('includes\conexion.php'); // Incluye la conexión a la base de datos

// Verifica si se ha proporcionado un ID de contacto
if (!isset($_GET['id'])) {
    header("Location: contactos.php"); // Redirige si no se proporciona ID
    exit();
}

$id = $_GET['id'];

// Elimina el contacto de la base de datos
$sql = "DELETE FROM contactos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Contacto eliminado exitosamente.";
    header("Location: contactos.php"); // Redirige al listado de contactos
    exit();
} else {
    echo "Error: " . $stmt->error;
}
?>
