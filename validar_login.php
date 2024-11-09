<?php
session_start();

include('includes/conexion.php'); // Incluye la conexión a la base de datos

// Verifica si se han enviado los datos del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $respuesta_usuario = $_POST['respuesta'];

    // Validación de la respuesta de la pregunta
    if ($respuesta_usuario == $_SESSION['respuesta_correcta']) {
        // Validaciones de seguridad de la contraseña
        if (strlen($contrasena) < 8 || !preg_match('/[A-Za-z]/', $contrasena) || !preg_match('/[0-9]/', $contrasena) || !preg_match('/[^\w]/', $contrasena)) {
            echo "La contraseña debe tener al menos 8 caracteres, incluyendo letras, números y caracteres especiales.";
        } else {
            // Prepara la consulta para buscar el usuario
            $stmt = $conn->prepare("SELECT * FROM usuarios WHERE correo = ? AND contraseña = ?");
            $stmt->bind_param("ss", $correo, $contrasena);

            // Ejecuta la consulta
            $stmt->execute();
            $resultado = $stmt->get_result();

            // Verifica si se encontró el usuario
            if ($resultado->num_rows > 0) {
                // El usuario existe, inicia la sesión
                $usuario = $resultado->fetch_assoc();
                $_SESSION['usuario'] = $usuario['nombre']; // Asegúrate de que el campo 'nombre' exista en tu tabla

                // Registro de actividad de inicio de sesión exitoso
                $ip_usuario = $_SERVER['REMOTE_ADDR'];
                $hora_actual = date('Y-m-d H:i:s');
                $log = fopen('login_activity.log', 'a');
                fwrite($log, "Inicio de sesión exitoso: Usuario: $correo, IP: $ip_usuario, Hora: $hora_actual\n");
                fclose($log);

                header("Location: menu.php"); // Redirige al menú principal
                exit();
            } else {
                // Registro de actividad de intento fallido
                $ip_usuario = $_SERVER['REMOTE_ADDR'];
                $hora_actual = date('Y-m-d H:i:s');
                $log = fopen('login_activity.log', 'a');
                fwrite($log, "Intento fallido: Usuario: $correo, IP: $ip_usuario, Hora: $hora_actual\n");
                fclose($log);

                echo "Usuario o contraseña incorrectos.";
            }

            // Cierra la declaración
            $stmt->close();
        }
    } else {
        echo "Respuesta incorrecta a la pregunta de validación.";
    }
}

// Cierra la conexión
$conn->close();
