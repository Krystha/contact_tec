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
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];

    // Inserta el nuevo contacto en la base de datos
    $sql = "INSERT INTO contactos (nombre, telefono, correo, direccion) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $telefono, $correo, $direccion);

    if ($stmt->execute()) {
        echo "Contacto registrado exitosamente.";
        header("Location: contactos.php"); // Redirige al listado de contactos
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
    <title>Agregar Contacto - Contacte Tec</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<h1>Agregar Contacto</h1>

<form method="post" action="agregar_contacto.php">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" required>

    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" id="telefono" required>

    <label for="correo">Correo:</label>
    <input type="email" name="correo" id="correo" required>

    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" id="direccion" required>

    <button type="submit">Registrar Contacto</button>
</form>

</body>
</html>
