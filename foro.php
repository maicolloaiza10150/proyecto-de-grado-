<?php
session_start();

if (!isset($_SESSION["user_name"])) {
    $_SESSION["redirect_url"] = "foro.php";
    header("Location: login.php");
    exit();
}

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
            background-color: #ffff; /* Encabezado */
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .navbar .left-buttons, .navbar .right-buttons {
            display: flex;
            align-items: center;
        }

        .navbar .logo {
            flex-grow: 1;
            text-align: center;
            margin-left: -120px; /* Ajusta este valor según tus necesidades */
        }

        .navbar .logo img {
            height: 40px;
        }

        .navbar button {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .navbar button:hover {
            background-color: #218838;
            transform: scale(1.15);
        }

        .container {
            flex: 1;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container a {
            display: block;
            color: #007bff;
            text-decoration: none;
            margin: 10px 0;
            font-size: 18px;
        }

        footer {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: auto;
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="left-buttons">
        <button type="button" onclick="window.location.href='nuevo_tema.php'">Agregar Nuevo Tema</button>
    </div>
    <div class="logo">
        <img src="imagenes/logo.png" alt="Logo"> <!-- Logo en el centro del encabezado -->
    </div>
    <div class="right-buttons">
        <!-- Aquí puedes agregar otros botones si es necesario -->
    </div>
</div>

<div class="container">
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

    // Realizar una consulta SQL
    $sql = "SELECT * FROM tema_foro";
 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mostrar los datos de cada fila
        while ($row = $result->fetch_assoc()) {
            echo "<a href='tema.php?id=" . htmlspecialchars($row["idtema_foro"]) . "'>" . htmlspecialchars($row["titulo"]) . "</a><br>";
        }
    } else {
        echo "No hay temas disponibles";
    }

    $conn->close();
    ?>
</div>

<footer>
    <p>Derechos reservados © 2024</p>
</footer>

</body>
</html>
