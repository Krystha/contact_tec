<?php
session_start();
session_destroy(); // Destruye la sesión actual
header("Location: index.php"); // Redirige al usuario a la página de inicio de sesión
exit();
?>
