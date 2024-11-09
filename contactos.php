<?php
session_start();

// Verifica que el usuario esté logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

include('includes\conexion.php'); // Incluye la conexión a la base de datos

// Consulta para obtener los contactos
$sql = "SELECT * FROM contactos";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Contactos - Contacte Tec</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<h1>Listado de Contactos</h1>

<a href="agregar_contacto.php">Agregar Contacto</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Dirección</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($resultado->num_rows > 0): ?>
            <?php while($contacto = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $contacto['id']; ?></td>
                    <td><?php echo $contacto['nombre']; ?></td>
                    <td><?php echo $contacto['telefono']; ?></td>
                    <td><?php echo $contacto['correo']; ?></td>
                    <td><?php echo $contacto['direccion']; ?></td>
                    <td>
                        <a href="editar_contacto.php?id=<?php echo $contacto['id']; ?>">Editar</a> | 
                        <a href="eliminar_contacto.php?id=<?php echo $contacto['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este contacto?');">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No hay contactos registrados.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link al archivo CSS para darle estilo -->
</head>
<body>

<div class="container">
    <div class="contact-info">
        <h2>Información del Contacto</h2>
        <form action="update_contact.php" method="POST">
            <label for="id_contacto">ID de Contacto:</label>
            <input type="text" id="id_contacto" name="id_contacto" value="<?php echo $id_contacto; ?>" readonly>

            <label for="puesto">Puesto:</label>
            <input type="text" id="puesto" name="puesto" value="<?php echo $puesto; ?>">

            <label for="telefono_contacto">Teléfono del Contacto:</label>
            <input type="text" id="telefono_contacto" name="telefono_contacto" value="<?php echo $telefono_contacto; ?>">

            <label for="correo_contacto">Correo del Contacto:</label>
            <input type="email" id="correo_contacto" name="correo_contacto" value="<?php echo $correo_contacto; ?>">
            
            <button type="submit">Guardar Cambios</button>
        </form>
    </div>

    <div class="company-info">
        <h2>Información de la Empresa</h2>
        <p><strong>Nombre de la Empresa:</strong> <?php echo $nombre_empresa; ?></p>
        <p><strong>Teléfono de la Empresa:</strong> <?php echo $telefono_empresa; ?></p>
    </div>

    <div class="history-status">
        <h2>Estado de Historial</h2>
        <p>Historial de interacciones con el contacto aparecerá aquí...</p>
    </div>
</div>

</body>
</html>
