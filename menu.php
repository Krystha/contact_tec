<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica que el usuario esté logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal - Contact Tec</title>
    <link rel="stylesheet" href="./css/estilos.css">
</head>

<body>

    <div class="header">
        <h1>Bienvenido a Contacte Tec</h1>
    </div>

    <div class="menu">
        <ul>
            <li><a href="./index.php">Inicio</a></li>
            <li><a href="./llamadas.php">Llamadas</a></li>
            <li><a href="./contactos.php">Contactos</a></li>
            <li><a href="Base de Datos.php">Base de Datos</a></li>
            <li><a href="reportes.php">Reportes</a></li> <!-- Nueva opción de reportes -->
            <li><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
        <div class="usuario">
            <?php echo $usuario; ?> <!-- Muestra el nombre del usuario -->
            <span class="opciones">⚙️</span> <!-- Icono de configuración -->
            <a href="./logout.php"><img src="imagenes/logout-icon.png" alt="Cerrar sesión"></a> <!-- Icono de cerrar sesión -->
        </div>
    </div>

</body>

</html>