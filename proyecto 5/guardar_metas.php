<?php
session_start();

// Verifica que el usuario esté logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

require 'conexion.php'; // Incluye el archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $usuario = $_SESSION['usuario'];
    $llamadas_efectivas = $_POST['llamadas_efectivas'];
    $citas_realizadas = $_POST['citas_realizadas'];
    $mes = $_POST['mes'];
    $año = $_POST['año'];

    // Prepara y ejecuta la consulta para insertar las metas
    $sql = "INSERT INTO metas (usuario, mes, llamadas_efectivas, citas_realizadas, año) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssiii", $usuario, $mes, $llamadas_efectivas, $citas_realizadas, $año);
        if ($stmt->execute()) {
            echo "Metas guardadas exitosamente.";
        } else {
            echo "Error al guardar las metas: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }
}

// Cierra la conexión
$conn->close();
?>
