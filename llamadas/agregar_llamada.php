<?php
session_start();

// Verifica que el usuario esté logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

include('../includes/conexion.php'); // Incluye la conexión a la base de datos

// Obtener la lista de contactos para el formulario
$sql_contactos = "SELECT * FROM contactos";
$result_contactos = $conn->query($sql_contactos);

// Obtener la lista de estados para el formulario
$sql_estados = "SELECT * FROM estado_llamada";
$result_estados = $conn->query($sql_estados);

// Obtener la lista de empresas para el formulario
$sql_empresas = "SELECT * FROM empresas";
$result_empresas = $conn->query($sql_empresas);

// Obtener la lista de asesores para el formulario
$sql_asesores = "SELECT * FROM asesores";
$result_asesores = $conn->query($sql_asesores);

// Obtener la lista de corporaciones para el formulario
$sql_corporaciones = "SELECT * FROM corporaciones";
$result_corporaciones = $conn->query($sql_corporaciones);

// Obtener la lista de productos para el formulario
$sql_productos = "SELECT * FROM productos";
$result_productos = $conn->query($sql_productos);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura y sanitiza los datos del formulario
    $id_empresa = $_POST['id_empresa'];
    $id_contacto = $_POST['id_contacto'];
    $id_corporacion = $_POST['id_corporacion'];
    $id_estado = $_POST['id_estado'];
    $id_producto = $_POST['id_producto'];
    $id_asesor = $_POST['id_asesor'];
    $fecha_llamada = $_POST['fecha_llamada'];
    $nota = $_POST['nota'];

    // Inserta la nueva llamada en la base de datos
    $sql = "INSERT INTO llamadas (id_empresa, id_contacto, id_corporacion, id_estado_llamada, id_producto, id_asesor, fecha_llamada, nota) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiiiiiis", $id_empresa, $id_contacto, $id_corporacion, $id_estado, $id_producto, $id_asesor, $fecha_llamada, $nota);

    if ($stmt->execute()) {
        echo "Llamada registrada exitosamente.";
        header("Location: ../llamadas.php"); // Redirige al listado de llamadas
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Llamada - Contacte Tec</title>
    <link rel="stylesheet" href="../css/estilos.css"> <!-- Ajusta la ruta si es necesario -->
</head>

<body> <?php include '../menu.php'; ?>

    <h1>Agregar Llamada</h1>

    <form method="post" action="agregar_llamada.php">
        <label for="id_empresa">Empresa:</label>
        <select name="id_empresa" id="id_empresa" required>
            <?php while ($empresa = $result_empresas->fetch_assoc()): ?>
                <option value="<?php echo $empresa['id']; ?>"><?php echo $empresa['nombre_empresa']; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="id_contacto">Contacto:</label>
        <select name="id_contacto" id="id_contacto" required>
            <?php while ($contacto = $result_contactos->fetch_assoc()): ?>
                <option value="<?php echo $contacto['id']; ?>"><?php echo $contacto['nombre_contacto']; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="id_corporacion">Corporación:</label>
        <select name="id_corporacion" id="id_corporacion" required>
            <?php while ($corporacion = $result_corporaciones->fetch_assoc()): ?>
                <option value="<?php echo $corporacion['id']; ?>"><?php echo $corporacion['nombre']; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="id_estado">Estado:</label>
        <select name="id_estado" id="id_estado" required>
            <?php while ($estado = $result_estados->fetch_assoc()): ?>
                <option value="<?php echo $estado['id_estado']; ?>"><?php echo $estado['nombre_estado']; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="id_producto">Producto:</label>
        <select name="id_producto" id="id_producto" required>
            <?php while ($producto = $result_productos->fetch_assoc()): ?>
                <option value="<?php echo $producto['id']; ?>"><?php echo $producto['nombre_producto']; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="id_asesor">Asesor:</label>
        <select name="id_asesor" id="id_asesor" required>
            <?php while ($asesor = $result_asesores->fetch_assoc()): ?>
                <option value="<?php echo $asesor['id']; ?>"><?php echo $asesor['nombre_asesor']; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="fecha_llamada">Fecha de Llamada:</label>
        <input type="date" name="fecha_llamada" id="fecha_llamada" required>

        <label for="nota">Nota:</label>
        <textarea name="nota" id="nota" required></textarea>

        <button type="submit">Registrar Llamada</button>
    </form>

</body>

</html>