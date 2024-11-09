<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - Contact Tec</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <div class="container">
        <div class="image-container">
            <img src="img/contact_tec.jpg" alt="Bienvenido a Contacte Tec">
        </div>
        <div class="form-container">
            <h1>Bienvenido a Contacte Tec</h1>
            <form action="validar_login.php" method="POST">
                <input type="email" name="correo" placeholder="Correo" required>
                <input type="password" name="contrasena" placeholder="Contraseña" required>
                <label for="pregunta"><?php
                                        // Genera dos números aleatorios para la pregunta de validación
                                        $numero1 = rand(1, 10);
                                        $numero2 = rand(1, 10);
                                        $suma_correcta = $numero1 + $numero2;

                                        // Guarda la pregunta y la respuesta correcta en la sesión
                                        session_start();
                                        $_SESSION['pregunta'] = "¿Cuánto es $numero1 + $numero2?";
                                        $_SESSION['respuesta_correcta'] = $suma_correcta;

                                        echo $_SESSION['pregunta'];
                                        ?></label>
                <input type="text" name="respuesta" placeholder="Respuesta" required>
                <input type="submit" value="Iniciar Sesión">
            </form>
        </div>
    </div>
</body>

</html>