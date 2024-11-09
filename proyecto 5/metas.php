<?php
session_start();

// Verifica que el usuario esté logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null; // Asegúrate de que esto esté definido

// Conexión a la base de datos
require 'conexion.php'; // Asegúrate de que este archivo tenga la conexión correcta

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Procesar el formulario para guardar las metas
    $anio = $_POST['anio'];
    $llamadas = $_POST['llamadas'];
    $citas = $_POST['citas'];

    // Guarda las metas en la base de datos
    $stmt = $conn->prepare("INSERT INTO metas (usuario_id, anio, llamadas, citas) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiii", $usuario_id, $anio, $llamadas, $citas);
    
    if ($stmt->execute()) {
        echo "Metas guardadas exitosamente.";
    } else {
        echo "Error al guardar las metas: " . $conn->error;
    }

    $stmt->close();
}

// Consulta las metas existentes
$result = $conn->query("SELECT * FROM metas WHERE usuario_id = $usuario_id");

// Cierra la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metas - Contacte Tec</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<div class="header">
    <h1>Metas de <?php echo htmlspecialchars($usuario); ?></h1>
</div>

<form method="POST" action="metas.php">
    <label for="anio">Año:</label>
    <input type="number" id="anio" name="anio" required>
    
    <label for="llamadas">Llamadas Efectivas:</label>
    <input type="number" id="llamadas" name="llamadas" required>
    
    <label for="citas">Citas Realizadas:</label>
    <input type="number" id="citas" name="citas" required>
    
    <input type="submit" value="Guardar Metas">
</form>

<h2>Metas Guardadas</h2>
<table>
    <tr>
        <th>Año</th>
        <th>Llamadas Efectivas</th>
        <th>Citas Realizadas</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo htmlspecialchars($row['anio']); ?></td>
        <td><?php echo htmlspecialchars($row['llamadas']); ?></td>
        <td><?php echo htmlspecialchars($row['citas']); ?></td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
