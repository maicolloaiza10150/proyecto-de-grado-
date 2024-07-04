<?php
session_start(); // Iniciar la sesión

include 'conexion.php';


function addMovilData($conn, $newData) {
    $columns = '';
    $values = '';
    foreach ($newData as $key => $value) {
        $columns .= "`$key`, ";
        if($key == 'foto'){
            $values .= "'". $value ."', ";
        }else{
            $values .= "'$value', ";
        }
    }
    $columns = rtrim($columns, ', ');
    $values = rtrim($values, ', ');

    $sql = "INSERT INTO movil ($columns) VALUES ($values)";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo registro creado con éxito.";
    } else {
        echo "Error al crear el registro: " . $conn->error;
    }
}

function getOptions($conn, $table, $idColumn, $valueColumn) {
    $sql = "SELECT $idColumn, $valueColumn FROM $table ORDER BY $valueColumn DESC";
    $result = $conn->query($sql);
    $options = "";
    while($row = $result->fetch_assoc()) {
        $options .= "<option value='" . $row[$idColumn] . "'>" . $row[$valueColumn] . "</option>";
    }
    return $options;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        'procesador_idprocesador' => $_POST['procesador_idprocesador'],
        'sistema_operativo_idsistema_operativo' => $_POST['sistema_operativo_idsistema_operativo'],
        'marca_idmarca' => $_POST['marca_idmarca'],
        'pantalla_idpantalla' => $_POST['pantalla_idpantalla'],
        'capa_android_idcapa_android' => $_POST['capa_android_idcapa_android'],
    );
    if(isset($_FILES['imagen'])){
        $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
        $newData['foto'] = $imagen;
    }
    addMovilData($conn, $newData);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Móvil</title>
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
            background-color: #ffff; /*encabezado*/
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 1.2); /*sombra del contenedor*/
            border-radius: 12px; /*bordos redondos*/
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
            border-radius: 15px; /*bordo de casillas*/

            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        input[type=text]:hover, select:hover {
            transform: scale(1.02);
            border-color: #4CAF50;
        }

        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;/*boton agregar*/
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
            echo "<img src='imagenes/usuario.ico' alt='Usuario'><p>" . $_SESSION["user_name"] . "</p>"; //usuario registrado //
        } else {
            echo "<a href='login.php' class='btn'>Iniciar sesión</a>";
        }
        ?>
    </div>
</div>

<div class="container">
    <h1>Agregar Móvil</h1>
    <form method="post" enctype="multipart/form-data">
        <table>
            <!-- Aquí es donde agregas el botón para subir imagen -->
            <tr>
                <th>Imagen</th>
                <td><input type="file" name="imagen"></td>
            </tr>
            <tr>
                <th>Modelo</th>
                <td><input type="text" name="modelo"></td>
            </tr>
            <tr>
                <th>Tamaño de pantalla</th>
                <td><input type="text" name="tamaño_pantalla"></td>
            </tr>
            <tr>
                <th>Almacenamiento</th>
                <td><input type="text" name="almacenamiento"></td>
            </tr>
            <tr>
                <th>Tipo de almacenamiento</th>
                <td><input type="text" name="tipo_almacenamiento"></td>
            </tr>
            <tr>
                <th>RAM</th>
                <td><input type="text" name="ram"></td>
            </tr>
            <tr>
                <th>Tipo de RAM</th>
                <td><input type="text" name="tipo_ram"></td>
            </tr>
            <tr>
                <th>Cámara principal</th>
                <td><input type="text" name="can_principal"></td>
            </tr>
            <tr>
                <th>Resolución de la cámara principal</th>
                <td><input type="text" name="resolucion_principal"></td>
            </tr>
            <tr>
                <th>Cámara gran angular</th>
                <td><input type="text" name="can_gran"></td>
            </tr>
            <tr>
                <th>Resolución de la cámara gran angular</th>
                <td><input type="text" name="resolucion_gran"></td>
            </tr>
            <tr>
                <th>Cámara teleobjetivo</th>
                <td><input type="text" name="can_tele"></td>
            </tr>
            <tr>
                <th>Resolución de la cámara teleobjetivo</th>
                <td><input type="text" name="resolucion_tele"></td>
            </tr>
            <tr>
                <th>Cámara macro</th>
                <td><input type="text" name="can_macro"></td>
            </tr>
            <tr>
                <th>Resolución de la cámara macro</th>
                <td><input type="text" name="resolucion_macro"></td>
            </tr>
            <tr>
                <th>Batería</th>
                <td><input type="text" name="bateria"></td>
            </tr>
            <tr>
                <th>Precio</th>
                <td><input type="text" name="precio"></td>
            </tr>
            <tr>
                <th>Descripción</th>
                <td><input type="text" name="descripcion"></td>
            </tr>
            <tr>
                <th>Procesador</th>
                <td>
                    <select name="procesador_idprocesador">
                        <?php echo getOptions($conn, 'procesador', 'idprocesador', 'modelo_procesador'); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Sistema Operativo</th>
                <td>
                    <select name="sistema_operativo_idsistema_operativo">
                        <?php echo getOptions($conn, 'sistema_operativo', 'idsistema_operativo', 'version'); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Marca</th>
                <td>
                    <select name="marca_idmarca">
                        <?php echo getOptions($conn, 'marca', 'idmarca', 'nombre_marca'); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Pantalla</th>
                <td>
                    <select name="pantalla_idpantalla">
                        <?php echo getOptions($conn, 'pantalla', 'idpantalla', 'resolucion'); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Capa Android</th>
                <td>
                    <select name="capa_android_idcapa_android">
                        <?php echo getOptions($conn, 'capa_android', 'idcapa_android', 'nombre_capa'); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Agregar móvil"></td>
            </tr>
        </table>
    </form>
</div>

<footer>
    <p>Derechos reservados © 2024</p>
</footer>

</body>
</html>