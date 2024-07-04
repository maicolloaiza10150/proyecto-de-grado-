<?php
session_start();

if (!isset($_SESSION["idusuarios"])) {
    header("Location: login.php");
    exit();
}

include 'conexion.php';


// Obtén el ID del tema de la URL
$idtema_foro = $_GET["id"];

// Procesar el formulario de nuevo comentario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comentario = $_POST["comentario"];
    $userId = $_SESSION["idusuarios"];
    $fecha_creacion = date("Y-m-d H:i:s"); // Agrega la fecha y hora actuales

    $sql = "INSERT INTO comentario_foro (contenido_coment, usuarios_idusuarios, tema_foro_idtema_foro, fecha_creacion) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siis", $comentario, $userId, $idtema_foro, $fecha_creacion);
    $stmt->execute();
    $stmt->close();

    // Redirigir de vuelta a la página del tema
    header("Location: tema.php?id=" . $idtema_foro);
    exit();
}

// Realizar una consulta SQL para obtener los comentarios y los nombres de los usuarios
$sqlComentarios = "SELECT comentario_foro.*, usuarios.user_name FROM comentario_foro JOIN usuarios ON comentario_foro.usuarios_idusuarios = usuarios.idusuarios WHERE tema_foro_idtema_foro = ?";
$stmtComentarios = $conn->prepare($sqlComentarios);
$stmtComentarios->bind_param("i", $idtema_foro);
$stmtComentarios->execute();
$resultComentarios = $stmtComentarios->get_result();

$stmtComentarios->close();
$conn->close();
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

<h2>Comentarios</h2>
<?php while ($rowComentario = $resultComentarios->fetch_assoc()): ?>
    <div class="comentario">
        <p><strong><?php echo htmlspecialchars($rowComentario["user_name"]); ?></strong> - <?php echo htmlspecialchars($rowComentario["fecha_creacion"]); ?></p>
        <p><?php echo htmlspecialchars($rowComentario["contenido_coment"]); ?></p>
    </div>
<?php endwhile; ?>

</body>
</html>
