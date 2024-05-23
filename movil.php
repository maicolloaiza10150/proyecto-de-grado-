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

// Obtener el ID del móvil de la URL
$idmovil = $_GET["id"];

// Realizar una consulta SQL
$sql = "SELECT movil.*, sistema_operativo.nombre_os, pantalla.resolucion, tec_pantalla.tecnologia 
        FROM movil 
        INNER JOIN sistema_operativo ON movil.sistema_operativo_idsistema_operativo = sistema_operativo.idsistema_operativo 
        INNER JOIN pantalla ON movil.pantalla_idpantalla = pantalla.idpantalla 
        INNER JOIN tec_pantalla ON pantalla.tec_pantalla_idtec_pantalla = tec_pantalla.idtec_pantalla 
        WHERE idmovil = $idmovil";
$result = $conn->query($sql);

$movil = null;
if ($result->num_rows > 0) {
    $movil = $result->fetch_assoc();
} else {
    echo "No se encontró el móvil";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Especificaciones del Móvil</title>
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
    <?php if ($movil): ?>
        <h1>Especificaciones del Móvil</h1>
        <table class="specs-table">
            <tr>
                <th>Modelo</th>
                <td><?php echo htmlspecialchars($movil["modelo"]); ?></td>
            </tr>
            <tr>
                <th>Tamaño de pantalla</th>
                <td><?php echo htmlspecialchars($movil["tamaño_pantalla"]); ?></td>
            </tr>
            <tr>
                <th>Almacenamiento</th>
                <td><?php echo htmlspecialchars($movil["almacenamiento"]); ?></td>
            </tr>
            <tr>
                <th>Tipo de almacenamiento</th>
                <td><?php echo htmlspecialchars($movil["tipo_almacenamiento"]); ?></td>
            </tr>
            <tr>
                <th>RAM</th>
                <td><?php echo htmlspecialchars($movil["ram"]); ?></td>
            </tr>
            <tr>
                <th>Tipo de RAM</th>
                <td><?php echo htmlspecialchars($movil["tipo_ram"]); ?></td>
            </tr>
            <tr>
                <th>Cámara principal</th>
                <td><?php echo htmlspecialchars($movil["can_principal"]); ?></td>
            </tr>
            <tr>
                <th>Resolución de la cámara principal</th>
                <td><?php echo htmlspecialchars($movil["resolucion_principal"]); ?></td>
            </tr>
            <tr>
                <th>Cámara gran angular</th>
                <td><?php echo htmlspecialchars($movil["can_gran"]); ?></td>
            </tr>
            <tr>
                <th>Resolución de la cámara gran angular</th>
                <td><?php echo htmlspecialchars($movil["resolucion_gran"]); ?></td>
            </tr>
            <tr>
                <th>Cámara teleobjetivo</th>
                <td><?php echo htmlspecialchars($movil["can_tele"]); ?></td>
            </tr>
            <tr>
                <th>Resolución de la cámara teleobjetivo</th>
                <td><?php echo htmlspecialchars($movil["resolucion_tele"]); ?></td>
            </tr>
            <tr>
                <th>Cámara macro</th>
                <td><?php echo htmlspecialchars($movil["can_macro"]); ?></td>
            </tr>
            <tr>
                <th>Resolución de la cámara macro</th>
                <td><?php echo htmlspecialchars($movil["resolucion_macro"]); ?></td>
            </tr>
            <tr>
                <th>Batería</th>
                <td><?php echo htmlspecialchars($movil["bateria"]); ?></td>
            </tr>
            <tr>
                <th>Precio</th>
                <td><?php echo htmlspecialchars($movil["precio"]); ?></td>
            </tr>
            <tr>
                <th>Descripción</th>
                <td><?php echo htmlspecialchars($movil["descripcion"]); ?></td>
            </tr>
            <tr>
                <th>Sistema Operativo</th>
                <td><?php echo htmlspecialchars($movil["nombre_os"]); ?></td>
            </tr>
            <tr>
                <th>Resolución de Pantalla</th>
                <td><?php echo htmlspecialchars($movil["resolucion"]); ?></td>
            </tr>
            <tr>
                <th>Tecnología de Pantalla</th>
                <td><?php echo htmlspecialchars($movil["tecnologia"]); ?></td>
            </tr>
        </table>
    <?php endif; ?>
</div>

<footer>
    <p>Derechos reservados &copy; 2024</p>
</footer>

</body>
</html>
