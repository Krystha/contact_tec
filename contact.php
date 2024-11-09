<?php
// Conexión a la base de datos
require 'database_connection.php';

$id_contacto = $_GET['id_contacto'] ?? 1; // ID de ejemplo
$query = "SELECT * FROM contactos WHERE id_contacto = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_contacto);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$id_contacto = $row['id_contacto'];
$puesto = $row['puesto'];
$telefono_contacto = $row['telefono_contacto'];
$correo_contacto = $row['correo_contacto'];
$nombre_empresa = $row['nombre_empresa'];
$telefono_empresa = $row['telefono_empresa'];

$stmt->close();
$conn->close();
?>
