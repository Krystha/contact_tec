<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - Contacte Tec</title>
    <link rel="stylesheet" href="estilos.css"> <!-- Enlaza a tu archivo CSS -->
    <style>
        
</head>
<body>

<div class="header">
    <img src="contact_tec.jpg" alt="Logo de Contacte Tec" class="logo"> <!-- Cambia el nombre de la imagen -->
    <div class="container">
        <h2>Bienvenido a Contacte Tec</h2>
        <form action="procesar_login.php" method="POST">
            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" id="correo" name="correo" required value="krysthamancilla@outlook.com"> <!-- Campo de correo prellenado -->
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required value="1234"> <!-- Campo de contraseña prellenado -->
            </div>
            <div class="form-group">
                <label for="suma">¿Cuánto es <span id="suma"></span>?</label>
                <input type="text" id="respuesta" name="respuesta" required>
            </div>
            <button type="submit" class="button">Iniciar Sesión</button>
        </form>
    </div>
</div>

<script>
    // Generar dos números aleatorios del 1 al 10 y mostrarlos en la suma
    const num1 = Math.floor(Math.random() * 10) + 1; // Número aleatorio entre 1 y 10
    const num2 = Math.floor(Math.random() * 10) + 1; // Otro número aleatorio entre 1 y 10
    document.getElementById("suma").textContent = num1 + " + " + num2; // Muestra la suma en el HTML
</script>

</body>
</html>
