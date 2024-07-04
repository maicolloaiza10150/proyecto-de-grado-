<?php
session_start();
if (isset($_GET['logout'])) {
    unset($_SESSION["user_name"]);
    header("Location: index.php");
    exit();
}

include 'conexion.php';


// Obtén el roles_idroles del usuario actualmente conectado
if (isset($_SESSION["user_name"])) {
    $sql = "SELECT roles_idroles FROM usuarios WHERE user_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION["user_name"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $_SESSION["roles_idroles"] = $user['roles_idroles'];
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
    color: #000; 
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

        /* Estilo para los formularios de búsqueda y filtro */
        .search-filter {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .search-filter form {
            flex-basis: 49%;
        }

        /* Estilo para los dispositivos */
        .device {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .device img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .device-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
    </style>
</head>
<body>
<div class="navbar">
    <div class="logo">
        <img src="imagenes/logo.png" alt="Logo"> <!-- Logo en el centro del encabezado -->
    </div>
    <button type="button" onclick="window.location.href='foro.php'">Foro</button> <!-- Botón agregado -->
    <?php if (isset($_SESSION["user_name"])): ?>
        <button type="button" onclick="window.location.href='agregar.php'">Agregar Dispositivo</button>
        <p>
            <img src="imagenes/usuario.ico" alt="Usuario" height="30"> <!-- Imagen icono de usuario -->
            <?php echo htmlspecialchars($_SESSION["user_name"]); ?>
        </p>
        <a href="?logout">Cerrar sesión</a>
    <?php else: ?>
        <a href="login.php">Iniciar sesión</a>
    <?php endif; ?>
</div>
<div class="container">
    <!-- Formularios de búsqueda y filtro -->
    <div class="search-filter">
        <form action="" method="GET">
            <input type="text" name="search" placeholder="Buscar móviles...">
            <input type="submit" value="Buscar">
        </form>

        <form action="" method="GET">
            <select name="marca">
                <option value="">Todas las marcas</option>
                <?php
                $sql = "SELECT * FROM marca";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row["idmarca"]) . "'>" . htmlspecialchars($row["nombre_marca"]) . "</option>";
                }
                ?>
            </select>
            <input type="submit" value="Filtrar">
        </form>

        <!-- Formulario de filtro por precio -->
        <form action="" method="GET">
            <select name="precio">
                <option value="">Todos los precios</option>
                <option value="200-300">200-300</option>
                <option value="300-500">300-500</option>
                <option value="500-700">500-700</option>
                <option value="700-900">700-900</option>
                <option value="900-">900 en adelante</option>
            </select>
            <input type="submit" value="Filtrar">
        </form>
    </div>

    <?php
    // Realizar una consulta SQL
    $sql = "SELECT * FROM movil";
    $whereClauses = [];
    if (isset($_GET['search']) && $_GET['search'] != '') {
        $search = mysqli_real_escape_string($conn, $_GET['search']);
        $whereClauses[] = "modelo LIKE '%$search%'";
    }
    if (isset($_GET['marca']) && $_GET['marca'] != '') {
        $marca = mysqli_real_escape_string($conn, $_GET['marca']);
        $whereClauses[] = "marca_idmarca = $marca";
    }
    if (isset($_GET['precio']) && $_GET['precio'] != '') {
        $precio = mysqli_real_escape_string($conn, $_GET['precio']);
        $rango = explode("-", $precio);
        if (count($rango) == 2) {
            $whereClauses[] = "precio >= $rango[0] AND precio <= $rango[1]";
        } else {
            $whereClauses[] = "precio >= $rango[0]";
        }
    }
    if (!empty($whereClauses)) {
        $sql .= ' WHERE ' . implode(' AND ', $whereClauses);
    }

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<div class='device-list'>";
        // Mostrar los datos de cada fila
        while ($row = $result->fetch_assoc()) {
            echo "<div class='device'>";
            // Genera una representación de la imagen para incluir en el HTML
            $foto = base64_encode($row["foto"]);
            echo "<a href='movil.php?id=" . htmlspecialchars($row["idmovil"]) . "'>";
            echo "<img src='data:image/jpeg;base64," . $foto . "' alt='Foto del dispositivo'>";
            echo "</a>";
            echo "<a href='movil.php?id=" . htmlspecialchars($row["idmovil"]) . "'>" . htmlspecialchars($row["modelo"]) . "</a>";
            if (isset($_SESSION["user_name"]) && isset($_SESSION["roles_idroles"]) && $_SESSION["roles_idroles"] == 1) {
                $idmovil = $row["idmovil"];
                echo "<div>";
                echo "<button type='button' onclick='location.href=\"edit.php?id=$idmovil\"'>Editar</button>";
                echo "<button type='button' class='delete-btn' onclick='confirmDelete($idmovil)'>Eliminar</button>";
                echo "</div>";
            }
            echo "</div>";
        }
        echo "</div>";
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