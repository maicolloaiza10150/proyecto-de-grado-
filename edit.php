<?php
session_start(); // Iniciar la sesión

include 'conexion.php';


// Obtener el ID del móvil de la URL
$idmovil = null;
if (isset($_GET["id"])) {
    $idmovil = mysqli_real_escape_string($conn, $_GET["id"]);
} else {
    die("Error: No se proporcionó el ID del móvil.");
}

$sql = "SELECT movil.*, sistema_operativo.nombre_os, pantalla.resolucion, tec_pantalla.tecnologia 
        FROM movil 
        INNER JOIN sistema_operativo ON movil.sistema_operativo_idsistema_operativo = sistema_operativo.idsistema_operativo 
        INNER JOIN pantalla ON movil.pantalla_idpantalla = pantalla.idpantalla 
        INNER JOIN tec_pantalla ON pantalla.tec_pantalla_idtec_pantalla = tec_pantalla.idtec_pantalla 
        WHERE idmovil = $idmovil";
$result = $conn->query($sql);

function updateMovilData($conn, $idmovil, $newData) {
    $set = '';
    foreach ($newData as $key => $value) {
        $set .= "`$key` = '$value', ";
    }
    $set = rtrim($set, ', ');

    $sql = "UPDATE movil SET $set WHERE idmovil = $idmovil";

    if ($conn->query($sql) === TRUE) {
        echo "Registro actualizado con éxito.";
    } else {
        echo "Error al actualizar el registro: " . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($idmovil)) {
    $newData = array(
        'modelo' => $_POST['modelo'],
        'tamaño_pantalla' => $_POST['tamaño_pantalla'],
        'almacenamiento' => $_POST['almacenamiento'],
        'tipo_almacenamiento' => $_POST['tipo_almacenamiento'],
        'ram' => $_POST['ram'],
        'tipo_ram' => $_POST['tipo_ram'],
        'can_principal' => $_POST['can_principal'],
        'resolucion_principal' => $_POST['resolucion_principal'],
        'can_gran' => $_POST['can_gran'],
        'resolucion_gran' => $_POST['resolucion_gran'],
        'can_tele' => $_POST['can_tele'],
        'resolucion_tele' => $_POST['resolucion_tele'],
        'can_macro' => $_POST['can_macro'],
        'resolucion_macro' => $_POST['resolucion_macro'],
        'bateria' => $_POST['bateria'],
        'precio' => $_POST['precio'],
        'descripcion' => $_POST['descripcion'],
    );
    updateMovilData($conn, $idmovil, $newData);
}

$movil = null;
if ($result->num_rows > 0) {
    $movil = $result->fetch_assoc();
} else {
    echo "No se encontró el móvil";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Especificaciones del Móvil</title>
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

        .navbar img {
            width: 50px;
            transition: transform 0.3s ease;
        }

        .navbar img:hover {
            transform: scale(1.1);
        }

        .navbar .right {
            display: flex;
            align-items: center;
        }

        .navbar .right img {
            width: 30px;
            margin-right: 10px;
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

        .container {
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            flex-grow: 1;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        input[type=text], select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            display: inline-block;
            border: 2px solid #ccc;
            border-radius: 15px;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        input[type=text]:hover, select:hover {
            transform: scale(1.02);
            border-color: #4CAF50;
        }

        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        input[type=submit]:hover {
            background-color: #45a049;
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
    </style>
</head>
<body>

<div class="navbar">
    <a href="index.php" class="btn left">Volver</a>
    <a href="#" class="logo"><img src="imagenes/logo.png" alt="Logo"></a>
    <div class="right">
        <?php
        if (isset($_SESSION["user_name"])) {
            echo "<img src='imagenes/usuario.ico' alt='Usuario'><p>" . $_SESSION["user_name"] . "</p>";
        } else {
            echo "<a href='login.php' class='btn'>Iniciar sesión</a>";
        }
        ?>
    </div>
</div>

<div class="container">
    <h1>Editar Especificaciones del Móvil</h1>
    <form method="post">
        <table>
            <tr>
                <th>Modelo</th>
                <td><input type="text" name="modelo" value="<?php echo htmlspecialchars($movil['modelo']); ?>"></td>
            </tr>
            <tr>
                <th>Tamaño de pantalla</th>
                <td><input type="text" name="tamaño_pantalla" value="<?php echo htmlspecialchars($movil['tamaño_pantalla']); ?>"></td>
            </tr>
            <tr>
                <th>Almacenamiento</th>
                <td><input type="text" name="almacenamiento" value="<?php echo htmlspecialchars($movil['almacenamiento']); ?>"></td>
            </tr>
            <tr>
                <th>Tipo de almacenamiento</th>
                <td><input type="text" name="tipo_almacenamiento" value="<?php echo htmlspecialchars($movil['tipo_almacenamiento']); ?>"></td>
            </tr>
            <tr>
                <th>RAM</th>
                <td><input type="text" name="ram" value="<?php echo htmlspecialchars($movil['ram']); ?>"></td>
            </tr>
            <tr>
                <th>Tipo de RAM</th>
                <td><input type="text" name="tipo_ram" value="<?php echo htmlspecialchars($movil['tipo_ram']); ?>"></td>
            </tr>
            <tr>
                <th>Cámara principal</th>
                <td><input type="text" name="can_principal" value="<?php echo htmlspecialchars($movil['can_principal']); ?>"></td>
            </tr>
            <tr>
                <th>Resolución de la cámara principal</th>
                <td><input type="text" name="resolucion_principal" value="<?php echo htmlspecialchars($movil['resolucion_principal']); ?>"></td>
            </tr>
            <tr>
                <th>Cámara gran angular</th>
                <td><input type="text" name="can_gran" value="<?php echo htmlspecialchars($movil['can_gran']); ?>"></td>
            </tr>
            <tr>
                <th>Resolución de la cámara gran angular</th>
                <td><input type="text" name="resolucion_gran" value="<?php echo htmlspecialchars($movil['resolucion_gran']); ?>"></td>
            </tr>
            <tr>
                <th>Cámara teleobjetivo</th>
                <td><input type="text" name="can_tele" value="<?php echo htmlspecialchars($movil['can_tele']); ?>"></td>
            </tr>
            <tr>
                <th>Resolución de la cámara teleobjetivo</th>
                <td><input type="text" name="resolucion_tele" value="<?php echo htmlspecialchars($movil['resolucion_tele']); ?>"></td>
            </tr>
            <tr>
                <th>Cámara macro</th>
                <td><input type="text" name="can_macro" value="<?php echo htmlspecialchars($movil['can_macro']); ?>"></td>
            </tr>
            <tr>
                <th>Resolución de la cámara macro</th>
                <td><input type="text" name="resolucion_macro" value="<?php echo htmlspecialchars($movil['resolucion_macro']); ?>"></td>
            </tr>
            <tr>
                <th>Batería</th>
                <td><input type="text" name="bateria" value="<?php echo htmlspecialchars($movil['bateria']); ?>"></td>
            </tr>
            <tr>
                <th>Precio</th>
                <td><input type="text" name="precio" value="<?php echo htmlspecialchars($movil['precio']); ?>"></td>
            </tr>
            <tr>
                <th>Descripción</th>
                <td><input type="text" name="descripcion" value="<?php echo htmlspecialchars($movil['descripcion']); ?>"></td>
            </tr>
        </table>
        <div class="action-buttons">
            <input type="submit" value="Guardar cambios">
        </div>
    </form>
</div>

<footer>
    <p>Derechos reservados © 2024</p>
</footer>

</body>
</html>
