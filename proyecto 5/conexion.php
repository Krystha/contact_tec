<?php
$host = 'localhost';        // Dirección del servidor
$dbname = 'contact_tec';     // Nombre de la base de datos
$usuario = 'root';          // Nombre de usuario de MySQL
$password = '';             // Contraseña del usuario de MySQL (por defecto, suele estar vacía en WAMP)


// Crear la conexión
$conexion = new mysqli($host, $usuario, $password, $base_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Establece el conjunto de caracteres a UTF-8 para evitar problemas con caracteres especiales
$conexion->set_charset("utf8");
?>
