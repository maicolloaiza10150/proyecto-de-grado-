<?php
session_start();
if (!isset($_SESSION["user_name"])) {
    $_SESSION["redirect_url"] = "moviles.php";
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Página</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <script>
    function confirmDelete(id) {
        var r = confirm("¿Estás seguro de que quieres eliminar este dispositivo?");
        if (r == true) {
            window.location.href = "delete.php?id=" + id;
        }
    }
    </script>
    <style>
        /* General body styling */
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Navbar styling */
        .navbar {
            background-color: #ffff;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
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

        .navbar p {
            margin: 0;
            color: #000;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .navbar p img {
            margin-right: 10px;
            border-radius: 50%;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }

        /* Logo styling */
        .navbar .logo {
            flex-grow: 1;
            text-align: center;
        }

        .navbar .logo img {
            height: 40px;
        }

        /* Container styling */
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

        .container button {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px;
            margin: 5px 10px 5px 0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .container button.delete-btn {
            background-color: #dc3545;
        }

        .container button:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        .container button.delete-btn:hover {
            background-color: #c82333;
        }

        .container table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .container th, .container td {
            border: 2px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .container th {
            background-color: #f2f2f2;
        }

        /* Footer styling */
        footer {
            background-color: #45a049;
            color: #fff;
            text-align: center;
            padding: 20px;
            position: relative;
            bottom: 0;
            width: 100%;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        /* Input styling */
        input[type="text"], input[type="submit"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #555;
        }

        input[type="text"]:hover, input[type="submit"]:hover {
            transform: scale(1.02);
            border-color: #777;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>

<div class="navbar">
    <button type="button" onclick="window.location.href='agregar.php'">Agregar Dispositivo</button>
    <div class="logo">
        <img src="imagenes/logo.png" alt="Logo"> <!-- Logo en el centro del encabezado -->
    </div>
    <button type="button" onclick="window.location.href='foro.php'">Foro</button> <!-- Botón agregado -->
    <?php if (isset($_SESSION["user_name"])): ?>
        <p>
            <img src="imagenes/usuario.ico" alt="Usuario" height="30"> <!-- Imagen icono de usuario -->
            <?php echo htmlspecialchars($_SESSION["user_name"]); ?>
        </p>
    <?php else: ?>
        <a href="login.php">Iniciar sesión</a>
    <?php endif; ?>
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
    $sql = "SELECT * FROM movil";
 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Modelo</th><th>Acciones</th></tr>";
        // Mostrar los datos de cada fila
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><a href='movil.php?id=" . htmlspecialchars($row["idmovil"]) . "'>" . htmlspecialchars($row["modelo"]) . "</a></td>";
            $idmovil = $row["idmovil"];
            echo "<td>";
            echo "<button type='button' onclick='location.href=\"edit.php?id=$idmovil\"'>Editar</button>";
            echo "<button type='button' class='delete-btn' onclick='confirmDelete($idmovil)'>Eliminar</button>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron móviles";
    }

    $conn->close();
    ?>
</div>

<footer>
    <p>Derechos reservados © 2024</p>
</footer>

</body>
</html>
