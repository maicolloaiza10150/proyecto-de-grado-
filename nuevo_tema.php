<?php

session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION["user_name"]) || !isset($_SESSION["idusuarios"])) {
    header("Location: login.php"); // Redireccionar si no ha iniciado sesión
    exit(); 
}

// Si el usuario está logueado, guarda sus datos en variables
$nombreUsuario = $_SESSION["user_name"];
$idUsuario = $_SESSION["idusuarios"];

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

// Insertar un nuevo tema
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $tema = $_POST["tema"];
    $userId = $_SESSION["idusuarios"];

    $sql = "INSERT INTO tema_foro (titulo, tema, usuarios_idusuarios) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $titulo, $tema, $userId);
    $stmt->execute();
    $stmt->close();

    // Redirigir al usuario al foro
    header("Location: foro.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Tema</title>
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
            margin-left: -20px; /* Ajusta este valor según tus necesidades */
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
            transform: scale(1.05);
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

        .container label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #000;
        }

        .container input[type="text"],
        .container textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .container input[type="text"]:focus,
        .container textarea:focus {
            outline: none;
            border-color: #555;
        }

        .container input[type="text"]:hover,
        .container textarea:hover {
            transform: scale(1.02);
            border-color: #777;
        }

        .container button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px;
            margin: 5px 0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .container button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
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

        .welcome-message {
            text-align: center;
            font-size: 18px;
            margin-top: 10px;
            color: #000;
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="left-buttons">
        <button type="button" onclick="window.location.href='foro.php'">Volver al Foro</button>
    </div>
    <div class="logo">
        <img src="imagenes/logo.png" alt="Logo"> <!-- Logo en el centro del encabezado -->
    </div>
    <div class="right-buttons">
        <!-- Aquí puedes agregar otros botones si es necesario -->
    </div>
</div>

<div class="welcome-message">
    <?php echo "Bienvenido, " . htmlspecialchars($nombreUsuario) . " (ID: " . htmlspecialchars($idUsuario) . ")"; ?>
</div>

<div class="container">
    <form action="nuevo_tema.php" method="post">
        <label for="titulo"><b>Título</b></label>
        <input type="text" placeholder="Ingresa el título del tema" name="titulo" required>

        <label for="tema"><b>Tema</b></label>
        <textarea placeholder="Ingresa el contenido del tema" name="tema" required></textarea>

        <button type="submit">Crear Tema</button>
    </form>
</div>

<footer>
    <p>Derechos reservados © 2024</p>
</footer>

</body>
</html>
