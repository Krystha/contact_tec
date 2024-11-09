<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $mes = $_POST['mes'];
    $año = $_POST['año'];
    $llamadas_efectivas = $_POST['llamadas_efectivas'];
    $citas_realizadas = $_POST['citas_realizadas'];

    $sql = "INSERT INTO metas (usuario, mes, año, llamadas_efectivas, citas_realizadas)
            VALUES ('$usuario', '$mes', '$año', '$llamadas_efectivas', '$citas_realizadas')";

    if (mysqli_query($conn, $sql)) {
        echo "Meta guardada exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
