<?php
session_start();

if (!isset($_SESSION["idusuarios"])) {
    header("Location: login.php");
    exit();
}

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

// Obtén el ID del tema de la URL"];
$idtema_foro = $_GET["id"];

// Procesar el formulario de nuevo comentario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comentario = $_POST["comentario"];
    $userId = $_SESSION["idusuarios"];

    $sql = "INSERT INTO comentario_foro (contenido_coment, usuarios_idusuarios, tema_foro_idtema_foro) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $comentario, $userId, $idtema_foro);
    $stmt->execute();
    $stmt->close();

    // Redirigir de vuelta a la página del tema
    header("Location: tema.php?id=" . $idtema_foro);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nuevo Comentario</title>
</head>
<body>

<h2>Nuevo Comentario</h2>
<form method="post" action="nuevo_comentario.php?id=<?php echo $idtema_foro; ?>">
    <textarea name="comentario" placeholder="Escribe tu comentario"></textarea>
    <button type="submit">Publicar Comentario</button>
</form>

</body>
</html>
