<?php
session_start();

include 'conexion.php';

// Guardar la URL de referencia al llegar a la página de inicio de sesión
if (!isset($_SESSION['referer_url']) && isset($_SERVER['HTTP_REFERER'])) {
    $_SESSION['referer_url'] = $_SERVER['HTTP_REFERER'];
}

// Iniciar sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST["user_name"];
    $contraseña = $_POST["contraseña"];

    // Preparar la consulta SQL
    $sql = "SELECT idusuarios, idroles
            FROM usuarios 
            INNER JOIN roles ON roles_idroles = idroles
            WHERE user_name = ? AND contraseña = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user_name, $contraseña);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Almacenar el nombre de usuario y el rol en variables de sesión
        $row = $result->fetch_assoc();
        $_SESSION["user_name"] = $user_name;
        $_SESSION["idusuarios"] = $row["idusuarios"];
        
        // Redirigir al usuario a la página de la que vino
        $redirect_url = isset($_SESSION['referer_url']) ? $_SESSION['referer_url'] : "index.php";
        header("Location: $redirect_url");
        // Limpiar la URL de referencia de la sesión
        unset($_SESSION['referer_url']);
    } else {
        echo "Nombre de usuario o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 1.2); /*sombras*/
            border-radius: 30px; /*bordos-redondos*/
            text-align: center;
        }

        .container img {
            width: 130px; /* Ajusta el tamaño del ícono */
            margin-bottom: 20px;
        }

        input[type=text], input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 20px;
            box-sizing: border-box;
        }

        input[type=text]:focus, input[type=password]:focus {
            border-color: #4CAF50;
            outline: none;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            margin: 10px 0;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.9);
        }

        button:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        .container label {
            margin: 8px 0;
            display: block;
            text-align: left;
        }

        .container label b {
            color: #333;
        }
    </style>
</head>
<body>

<form action="login.php" method="post" class="container">
    <img src="imagenes/logo.ico" alt="Logo">
    <label for="uname"><b>Nombre de usuario</b></label>
    <input type="text" placeholder="Ingresa tu nombre de usuario" name="user_name" required>

    <label for="psw"><b>Contraseña</b></label>
    <input type="password" placeholder="Ingresa tu contraseña" name="contraseña" required>

    <button type="submit">Iniciar sesión</button>
</form>

</body>
</html>
