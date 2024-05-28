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
        /* Reset de márgenes y padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Estilo del cuerpo */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }

        /* Estilo de la barra de navegación */
        .navbar {
            overflow: hidden;
            background-color: #444;
            padding: 10px 20px;
        }

        .navbar a, .navbar p, .navbar .btn {
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .navbar a:hover, .navbar .btn:hover {
            background-color: #ddd;
            color: #444;
        }

        .navbar .left {
            float: left;
        }

        .navbar .right {
            float: right;
        }

        /* Contenedor principal */
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        /* Estilo del cuadro de especificaciones */
        .specs-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .specs-table th, .specs-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .specs-table th {
            background-color: #f4f4f4;
        }

        /* Pie de página */
        footer {
            text-align: center;
            padding: 20px;
            background-color: #444;
            color: #fff;
            position: fixed;
            bottom: 0;
            width: 100%;
            border-top: 1px solid #333;
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