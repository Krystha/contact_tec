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

// Obtener los datos del usuario para editar
$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura y sanitiza los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    
    // Actualiza el usuario en la base de datos
    $sql = "UPDATE usuarios SET nombre = ?, correo = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nombre, $correo, $id);
    
    if ($stmt->execute()) {
        echo "Usuario actualizado exitosamente.";
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
    <title>Editar Usuario - Contacte Tec</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<h1>Editar Usuario</h1>

<form method="post" action="editar_usuario.php?id=<?php echo $id; ?>">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo $usuario['nombre']; ?>" required>
    
    <label for="correo">Correo:</label>
    <input type="email" name="correo" id="correo" value="<?php echo $usuario['correo']; ?>" required>
    
    <button type="submit">Actualizar Usuario</button>
</form>

</body>
</html>
