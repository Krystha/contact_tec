<?php
session_start();

// Verifica que el usuario esté logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

include('../includes/conexion.php'); // Incluye la conexión a la base de datos

// Verifica si se ha proporcionado un ID de llamada
if (!isset($_GET['id'])) {
    header("Location: ../llamadas.php"); // Redirige si no se proporciona ID
    exit();
}

$id = $_GET['id'];

// Elimina la llamada de la base de datos
$sql = "DELETE FROM llamadas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Llamada eliminada exitosamente.";
    header("Location: ../llamadas.php"); // Redirige al listado de llamadas
    exit();
} else {
    echo "Error: " . $stmt->error;
}
?>
