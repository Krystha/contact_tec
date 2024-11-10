<?php
session_start();

// Verifica que el usuario esté logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

include('includes/conexion.php'); // Incluye la conexión a la base de datos

// Consulta para obtener las llamadas
$sql = "SELECT * FROM v_llamadas2";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Llamadas - Contacte Tec</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="http://localhost/chatbot/styles/styles.css">
</head>

<body>

    <?php include 'menu.php'; ?>

    <h1>Listado de Llamadas</h1>

    <a href="llamadas/agregar_llamada.php">Agregar Llamada</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Estado de Llamada</th>
                <th>Corporacion</th>
                <th>Empresa</th>
                <th>Contacto</th>
                <th>Asesor</th>
                <th>Producto</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($resultado->num_rows > 0): ?>
                <?php while ($llamada = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $llamada['id']; ?></td>
                        <td><?php echo $llamada['nombre_estado']; ?></td>
                        <td><?php echo $llamada['nombre']; ?></td>
                        <td><?php echo $llamada['nombre_empresa']; ?></td>
                        <td><?php echo $llamada['nombre_contacto']; ?></td>
                        <td><?php echo $llamada['nombre_asesor']; ?></td>
                        <td><?php echo $llamada['nombre_producto']; ?></td>
                        <td>
                            <a href="llamadas/editar_llamada.php?id=<?php echo $llamada['id']; ?>">Editar</a> |
                            <a href="llamadas/eliminar_llamada.php?id=<?php echo $llamada['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta llamada?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No hay llamadas registradas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Contenedor para el chatbot -->
    <div id="chatbot"></div>

    <script src="http://localhost/chatbot/scripts/scripts.js"></script>
    <script>
        // Función para cargar el HTML del chatbot
        function loadChatbot() {
            const chatbotContainer = document.getElementById('chatbot');
            fetch('http://localhost/chatbot/index.html')
                .then(response => response.text())
                .then(data => {
                    chatbotContainer.innerHTML = data;
                    // Inicializa los eventos del chatbot después de cargar el HTML
                    initializeChatbot();
                })
                .catch(error => console.error('Error loading chatbot:', error));
        }

        // Cargar el chatbot al iniciar la página
        window.onload = loadChatbot;
    </script>

</body>

</html>