<?php
session_start();

$idtema_foro = $_GET["id"];

include 'conexion.php';


// Realizar una consulta SQL para obtener los detalles del tema
$sql = "SELECT * FROM tema_foro WHERE idtema_foro = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idtema_foro);
$stmt->execute();
$result = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foro</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
<style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            background-color: #ffffff; /* Encabezado */
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar .btn {
            color: white;
            background-color: #4CAF50;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .navbar .btn:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        .navbar .right {
            display: flex;
            align-items: center;
        }

        .navbar .right p {
            margin: 0;
            font-weight: bold;
            color: #000;
        }

        .navbar .right img {
            height: 40px;
            width: 40px;
            border-radius: 50%;
            margin-left: 10px;
        }

        .container {
            flex: 1;
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        .specs-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .specs-table th, .specs-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .specs-table th {
            background-color: #f2f2f2;
            color: #333;
        }

        .specs-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .specs-table tr:hover {
            background-color: #f1f1f1;
        }

        footer {
            background-color: #45a049;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: auto;
        }

        .action-buttons {
            text-align: center;
            margin-top: 20px;
        }

        .action-buttons input[type="submit"], .action-buttons a {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 15px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 5px;
        }

        .action-buttons input[type="submit"]:hover, .action-buttons a:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo img {
            height: 50px;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            background-color: #ffffff; /* Encabezado */
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar .btn {
            color: white;
            background-color: #4CAF50;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .navbar .btn:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        .navbar .right {
            display: flex;
            align-items: center;
        }

        .navbar .right p {
            margin: 0;
            font-weight: bold;
            color: #000;
        }

        .navbar .right img {
            height: 40px;
            width: 40px;
            border-radius: 50%;
            margin-left: 10px;
        }

        .container {
            flex: 1;
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        .specs-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .specs-table th, .specs-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .specs-table th {
            background-color: #f2f2f2;
            color: #333;
        }

        .specs-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .specs-table tr:hover {
            background-color: #f1f1f1;
        }

        footer {
            background-color: #45a049;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: auto;
        }

        .action-buttons {
            text-align: center;
            margin-top: 20px;
        }

        .action-buttons input[type="submit"], .action-buttons a {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 15px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 5px;
        }

        .action-buttons input[type="submit"]:hover, .action-buttons a:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo img {
            height: 50px;
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="logo">
        <img src="imagenes/logo.png" alt="Logo">
    </div>
    <div class="right">
        <?php if (isset($_SESSION["idusuarios"])): ?>
            <p><?php echo htmlspecialchars($_SESSION["user_name"]); ?></p>
            <img src="imagenes/usuario.ico" alt="Usuario">
            <a href="?logout" class="btn">Cerrar sesión</a>
        <?php else: ?>
            <a href="login.php" class="btn">Iniciar sesión</a>
        <?php endif; ?>
    </div>
</div>

<div class="container">
    <?php
    if ($result->num_rows > 0) {
        // Mostrar los detalles del tema
        $row = $result->fetch_assoc();
        echo "<h1>" . htmlspecialchars($row["titulo"]) . "</h1>";
        echo "<p>" . htmlspecialchars($row["tema"]) . "</p>";
        if (!empty($row["imagen"])) {
            echo "<img src='" . htmlspecialchars($row["imagen"]) . "' alt='Imagen del tema' style='width: 200px; height: auto;'>";
        }
    } else {
        echo "No se encontró el tema";
    }

    // Obtener y mostrar los comentarios
    $sqlComentarios = "SELECT * FROM comentario_foro WHERE tema_foro_idtema_foro = ?";
    $stmtComentarios = $conn->prepare($sqlComentarios);
    $stmtComentarios->bind_param("i", $idtema_foro);
    $stmtComentarios->execute();
    $resultComentarios = $stmtComentarios->get_result();

    echo "<h2>Comentarios</h2>";
    while ($rowComentario = $resultComentarios->fetch_assoc()) {
        echo "<div class='comentario'>";
        echo "<p><strong>" . htmlspecialchars($rowComentario["usuarios_idusuarios"]) . "</strong> - " . htmlspecialchars($rowComentario["fecha_creacion"]) . "</p>";
        echo "<p>" . htmlspecialchars($rowComentario["contenido_coment"]) . "</p>";
        echo "</div>";
    }

    $stmtComentarios->close();
    $stmt->close();
    $conn->close();
    ?>

<form method="post" action="nuevo_comentario.php?id=<?php echo $idtema_foro; ?>">
    <textarea name="comentario" placeholder="Escribe tu comentario"></textarea>
    <?php if (isset($_SESSION["idusuarios"])): ?>
        <button type="submit">Publicar Comentario</button>
    <?php else: ?>
        <p>Debes <a href="login.php">iniciar sesión</a> para publicar un comentario.</p>
    <?php endif; ?>
</form>
</div>

<footer>
    <p>Derechos reservados © 2024</p>
</footer>

</body>
</html>