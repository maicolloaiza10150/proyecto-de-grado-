<?php
session_start(); // Iniciar la sesión

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

$moviles = array();
if (isset($_SESSION["comparar"])) {
    foreach ($_SESSION["comparar"] as $idmovil) {
        $idmovil = mysqli_real_escape_string($conn, $idmovil);
        $sql = "SELECT movil.*, sistema_operativo.nombre_os, pantalla.resolucion, tec_pantalla.tecnologia 
                FROM movil 
                INNER JOIN sistema_operativo ON movil.sistema_operativo_idsistema_operativo = sistema_operativo.idsistema_operativo 
                INNER JOIN pantalla ON movil.pantalla_idpantalla = pantalla.idpantalla 
                INNER JOIN tec_pantalla ON pantalla.tec_pantalla_idtec_pantalla = tec_pantalla.idtec_pantalla 
                WHERE idmovil = $idmovil";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            array_push($moviles, $result->fetch_assoc());
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comparar Móviles</title>
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
    </style>
</head>
<body>

<div class="navbar">
    <a href="moviles.php" class="btn left">Volver</a>
    <?php
    if (isset($_SESSION["user_name"])) {
        echo "<p class='right'>" . $_SESSION["user_name"] . " </p>";
    } else {
        echo "<a href='login.php' class='right'>Iniciar sesión</a>";
    }
    ?>
</div>

<div class="container">
    <?php foreach ($moviles as $movil): ?>
        <div class="movil">
            <h2><?php echo htmlspecialchars($movil["modelo"]); ?></h2>
            <p>Tamaño de pantalla: <?php echo htmlspecialchars($movil["tamaño_pantalla"]); ?></p>
            <p>Almacenamiento: <?php echo htmlspecialchars($movil["almacenamiento"]); ?></p>
            <p>Tipo de almacenamiento: <?php echo htmlspecialchars($movil["tipo_almacenamiento"]); ?></p>
            <p>RAM: <?php echo htmlspecialchars($movil["ram"]); ?></p>
            <p>Tipo de RAM: <?php echo htmlspecialchars($movil["tipo_ram"]); ?></p>
            <p>Cámara principal: <?php echo htmlspecialchars($movil["can_principal"]); ?></p>
            <p>Resolución de la cámara principal: <?php echo htmlspecialchars($movil["resolucion_principal"]); ?></p>
            <!-- Agrega aquí el resto de las especificaciones del móvil -->
        </div>
    <?php endforeach; ?>
</div>
<footer>
    <p>Derechos reservados &copy; 2024</p>
</footer>

</body>
</html>