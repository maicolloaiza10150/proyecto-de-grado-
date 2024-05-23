<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Página</title>
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
            margin: 0;
            padding: 0;
        }

        /* Estilo de la barra de navegación */
        .navbar {
            overflow: hidden;
            background-color: #444;
            padding: 10px 20px;
        }

        .navbar a, .navbar p {
            float: right;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: #444;
        }

        .navbar p {
            float: left;
            font-weight: bold;
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

        /* Estilo de los enlaces */
        a {
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Estilo de los títulos */
        h1, h2, h3 {
            color: #444;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }

        /* Estilo de las listas */
        ul {
            list-style-type: none;
        }

        ul li {
            padding: 10px;
            margin-bottom: 10px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        /* Botón personalizado */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #3498db;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #2980b9;
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
    <?php if (isset($_SESSION["user_name"])): ?>
        <p><?php echo htmlspecialchars($_SESSION["user_name"]); ?></p>
    <?php else: ?>
        <a href="login.php">Iniciar sesión</a>
    <?php endif; ?>
</div>

<div class="container">
    <!-- Aquí va el resto de tu página -->
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
    $sql = "SELECT * FROM movil";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mostrar los datos de cada fila
        while ($row = $result->fetch_assoc()) {
            echo "<a href='movil.php?id=" . htmlspecialchars($row["idmovil"]) . "'>" . htmlspecialchars($row["modelo"]) . "</a><br>";
        }
    } else {
        echo "No se encontraron móviles";
    }

    $conn->close();
    ?>
</div>

<footer>
    <p>Derechos reservados &copy; 2024</p>
</footer>

</body>
</html>
