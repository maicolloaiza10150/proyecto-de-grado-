<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyectodb";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Asegúrate de que el ID es seguro para usar en la consulta SQL
$id = intval($_GET['id']);

// Realizar una consulta SQL para eliminar el dispositivo
$sql = "DELETE FROM movil WHERE idmovil = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: moviles.php");
    exit;
} else {
    echo "Error al eliminar dispositivo: " . $conn->error;
}

$conn->close();
?>
