<?php
session_start();

// Verifica que el usuario esté logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

include('conexion.php'); // Conexión a la base de datos

// Consulta para obtener el total de llamadas realizadas
$total_llamadas_sql = "SELECT COUNT(*) AS total_llamadas FROM llamadas";
$result_total_llamadas = $conn->query($total_llamadas_sql);
$total_llamadas = $result_total_llamadas->fetch_assoc()['total_llamadas'];

// Consulta para obtener llamadas por contacto
$llamadas_por_contacto_sql = "
    SELECT contactos.nombre, COUNT(llamadas.id) AS total_llamadas
    FROM contactos 
    LEFT JOIN llamadas ON contactos.id = llamadas.contacto_id 
    GROUP BY contactos.id";

$result_llamadas_por_contacto = $conn->query($llamadas_por_contacto_sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes - Contacte Tec</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="header">
        <h1>Reportes de Llamadas</h1>
    </div>

    <div class="contenido">
        <p>Total de Llamadas Realizadas: <?php echo $total_llamadas; ?></p>

        <h2>Llamadas por Contacto</h2>
        <table>
            <thead>
                <tr>
                    <th>Contacto</th>
                    <th>Total de Llamadas</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result_llamadas_por_contacto->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['total_llamadas']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
