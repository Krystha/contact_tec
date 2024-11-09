<?php
session_start(); // Iniciar la sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php"); // Redirigir si no hay sesión activa
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página de Bienvenida</title>
</head>
<body>
    <h2>Bienvenido, <?php echo $_SESSION['usuario']; ?>!</h2>
    <p>Has iniciado sesión exitosamente.</p>
    <a href="cerrar_sesion.php">Cerrar sesión</a> <!-- Cambia aquí -->
</body>
</html>
