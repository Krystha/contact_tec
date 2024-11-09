<?php
session_start();

// Verifica que el usuario esté logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

include('includes\conexion.php'); // Incluye la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura y sanitiza los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    
    // Inserta el nuevo usuario en la base de datos
    $sql = "INSERT INTO usuarios (nombre, correo) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nombre, $correo);
    
    if ($stmt->execute()) {
        echo "Usuario agregado exitosamente.";
        header("Location: usuarios.php"); // Redirige al listado de usuarios
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario - Contacte Tec</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<h1>Agregar Usuario</h1>

<form method="post" action="agregar_usuario.php">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" required>
    
    <label for="correo">Correo:</label>
    <input type="email" name="correo" id="correo" required>
    
    <button type="submit">Agregar Usuario</button>
</form>

</body>
</html>
