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
if (isset($_GET["id"])) {
    $idmovil = mysqli_real_escape_string($conn, $_GET["id"]);
} else {
    die("Error: No se proporcionó el ID del móvil.");
}

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION["comparar"])) {
        $_SESSION["comparar"] = array();
    }
    $key = array_search($idmovil, $_SESSION["comparar"]);
    if ($key !== false) {
        // Eliminar de la comparativa
        unset($_SESSION["comparar"][$key]);
        $_SESSION["comparar"] = array_values($_SESSION["comparar"]); // Reindexar el array
    } else {
        // Añadir a la comparativa
        array_push($_SESSION["comparar"], $idmovil);
    }
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
    <div class="logo">
        <img src="imagenes/logo.png" alt="Logo">
    </div>
    <div class="right">
        <?php
        if (isset($_SESSION["user_name"])) {
            echo "<img src='imagenes/usuario.ico' alt='Usuario'>";
            echo "<p>" . $_SESSION["user_name"] . "</p>";
        } else {
            echo "<a href='login.php' class='btn'>Iniciar sesión</a>";
        }
        ?>
    </div>
</div>

<div class="container">
    <?php if ($movil): ?>
        <div class="action-buttons">
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"] . '?id=' . $idmovil;?>">
                <input type="hidden" name="idmovil" value="<?php echo $idmovil; ?>">
                <input type="submit" value="<?php echo (isset($_SESSION["comparar"]) && in_array($idmovil, $_SESSION["comparar"])) ? 'Eliminar de la comparativa' : 'Añadir a la comparativa'; ?>">
            </form>
            <?php
            if (isset($_SESSION["comparar"]) && count($_SESSION["comparar"]) >= 2) {
                echo '<a href="comparar.php" class="btn">Comparar</a>';
            }
            ?>
        </div>
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
