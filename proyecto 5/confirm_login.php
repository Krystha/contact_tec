<?php
session_start();

// Verificar si hay un usuario temporal en la sesión
if (!isset($_SESSION['temp_user'])) {
    echo 'No se puede confirmar el inicio de sesión.';
    exit;
}

// Validar el usuario (esto debería ser más seguro en una aplicación real)
if (isset($_GET['user']) && isset($_GET['token'])) {
    $user = $_SESSION['temp_user'];

    // Aquí puedes agregar lógica adicional para validar el token

    // Si todo es correcto, puedes iniciar sesión
    $_SESSION['user'] = $user; // Guardar en la sesión el usuario final
    echo 'Inicio de sesión confirmado. Bienvenido, ' . htmlspecialchars($user);
    // Redirigir a la página principal o a otra parte de tu aplicación
} else {
    echo 'Enlace de confirmación no válido.';
}
?>
