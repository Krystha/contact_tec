<?php
session_start();

// Simulación de validación de usuario (deberías tener tu propia lógica de autenticación)
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Comprobar si el correo y la contraseña son correctos
if ($correo === 'krysthamancilla@outlook.com' && $contrasena === '1234') {
    $_SESSION['usuario'] = 'Krystha Mancilla'; // Guarda el nombre del usuario en la sesión
    header('Location: menu.php'); // Redirige al menú principal
    exit();
} else {
    echo "Usuario o contraseña incorrectos.";
    // Aquí puedes redirigir de nuevo a index.php o mostrar un mensaje de error
}
?>
