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

// Obtener los datos del contacto para editar
$sql = "SELECT * FROM contactos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$contacto = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura y sanitiza los datos del formulario
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];

    // Actualiza el contacto en la base de datos
    $sql = "UPDATE contactos SET nombre = ?, telefono = ?, correo = ?, direccion = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nombre, $telefono, $correo, $direccion, $id);

    if ($stmt->execute()) {
        echo "Contacto actualizado exitosamente.";
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
    <title>Editar Contacto - Contacte Tec</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<h1>Editar Contacto</h1>

<form method="post" action="editar_contacto.php?id=<?php echo $id; ?>">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo $contacto['nombre']; ?>" required>

    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" id="telefono" value="<?php echo $contacto['telefono']; ?>" required>

    <label for="correo">Correo:</label>
    <input type="email" name="correo" id="correo" value="<?php echo $contacto['correo']; ?>" required>

    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" id="direccion" value="<?php echo $contacto['direccion']; ?>" required>

    <button type="submit">Actualizar Contacto</button>
</form>

</body>
</html>
