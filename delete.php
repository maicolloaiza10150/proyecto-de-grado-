<?php
include 'conexion.php';

// Asegúrate de que el ID es seguro para usar en la consulta SQL
$id = intval($_GET['id']);

// Realizar una consulta SQL para eliminar el dispositivo
$sql = "DELETE FROM movil WHERE idmovil = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit;
} else {
    echo "Error al eliminar dispositivo: " . $conn->error;
}

$conn->close();
?>
