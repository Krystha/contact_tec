<?php
session_start();

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
    <title>Menú Principal - Contacte Tec</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: url('contact_tec.jpg') no-repeat center center fixed;
            background-size: contain;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .menu {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(0, 123, 255, 0.9);
            padding: 10px 20px;
            margin-bottom: 20px;
        }
        .menu ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .menu ul li {
            position: relative;
            margin-right: 20px;
        }
        .menu a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        .menu a:hover {
            text-decoration: underline;
        }
        .submenu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: rgba(0, 123, 255, 0.9);
            padding: 10px;
            border-radius: 4px;
            z-index: 1;
        }
        .submenu a {
            display: block;
            padding: 5px;
            color: white;
            font-weight: normal;
        }
        .usuario {
            margin-left: auto;
            color: white;
        }
        .opciones {
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Bienvenido a Contacte Tec</h1>
</div>

<div class="menu">
    <ul>
        <li><a href="Contacto.php">Contacto</a></li>
        <li><a href="Empresa.php">Empresa</a></li>
        <li><a href="Llamadas.php">Llamadas</a></li>
        <li><a href="Base_de_datos.php">Base de datos</a></li>
        <li>
            <a href="javascript:void(0);" id="bibliotecaLink" onclick="toggleSubmenu()">Biblioteca</a>
            <ul class="submenu" id="submenuBiblioteca">
                <li><a href="Metas.php">Metas</a></li>
                <li><a href="Informes.php">Informes</a></li>
            </ul>
        </li>
    </ul>
    <div class="usuario">
        <?php echo $usuario; ?>
        <span class="opciones">⚙️</span>
        <span class="opciones" onclick="cerrarSesion()">🔒</span>
    </div>
</div>

<script>
function toggleSubmenu() {
    var submenu = document.getElementById("submenuBiblioteca");
    var isVisible = submenu.style.display === "block";
    submenu.style.display = isVisible ? "none" : "block";
}

// Oculta el submenú al hacer clic fuera de él
document.addEventListener("click", function(event) {
    var submenu = document.getElementById("submenuBiblioteca");
    var bibliotecaLink = document.getElementById("bibliotecaLink");

    // Si el clic no es en el submenú o el enlace de "Biblioteca", oculta el submenú
    if (!submenu.contains(event.target) && event.target !== bibliotecaLink) {
        submenu.style.display = "none";
    }
});

function cerrarSesion() {
    if (confirm("¿Estás seguro de que deseas cerrar sesión?")) {
        window.location.href = 'cerrar_sesion.php';
    }
}
</script>

</body>
</html>
