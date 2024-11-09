<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['username'])) {
    header('Location: index.php'); // Redirigir si no está autenticado
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_code = $_POST['verification_code'];
    if ($input_code == $_SESSION['verification_code']) {
        // Código correcto, redirigir al menú principal
        header('Location: menu_principal.php'); // Cambia esto a tu página principal
        exit;
    } else {
        $error_message = "Código de verificación incorrecto.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Verificar Código</title>
</head>
<body>
    <h2>Verificación de Código</h2>
    <?php if (isset($error_message)) echo "<p style='color: red;'>$error_message</p>"; ?>
    <form action="" method="POST">
        <label for="verification_code">Ingresa el código enviado a tu correo:</label>
        <input type="text" id="verification_code" name="verification_code" required>
        <button type="submit">Verificar</button>
    </form>
</body>
</html>
