<!DOCTYPE html>
<html>
<head>
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
}

.container {
    width: 300px;
    padding: 16px;
    background-color: white;
    margin: 0 auto;
    margin-top: 100px;
    border: 1px solid black;
    border-radius: 4px;
}

input[type=text], input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
}

button:hover {
    opacity:1;
}
</style>
</head>
<body>

<form action="login.php" method="post" class="container">
    <label for="uname"><b>Nombre de usuario</b></label>
    <input type="text" placeholder="Ingresa tu nombre de usuario" name="user_name" required>

    <label for="psw"><b>Contraseña</b></label>
    <input type="password" placeholder="Ingresa tu contraseña" name="contraseña" required>

    <button type="submit">Iniciar sesión</button>
</form>

</body>
</html>
<?php
session_start();

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

// Iniciar sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST["user_name"];
    $contraseña = $_POST["contraseña"];

    $sql = "SELECT usuarios.idusuarios, idroles
            FROM usuarios 
            INNER JOIN roles ON roles_idroles = idroles
            WHERE user_name = '$user_name' AND contraseña = '$contraseña'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Almacenar el nombre de usuario y el rol en variables de sesión
        $row = $result->fetch_assoc();
        $_SESSION["user_name"] = $user_name;
        
        
        // Redirigir al usuario a la página de móviles
        header("Location: moviles.php");
    } else {
        echo "Nombre de usuario o contraseña incorrectos";
    }
}

$conn->close();
?>
