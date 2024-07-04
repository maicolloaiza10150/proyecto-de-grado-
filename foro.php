<?php
session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

include 'conexion.php';


// Realizar una consulta SQL
$sql = "SELECT * FROM tema_foro";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql .= " WHERE titulo LIKE '%$search%'";
}

$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foro</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
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
            background-color: #ffff; /* Encabezado */
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .navbar .left-buttons, .navbar .right-buttons {
            display: flex;
            align-items: center;
        }

        .navbar .logo {
            flex-grow: 1;
            text-align: center;
            margin-left: -120px; /* Ajusta este valor según tus necesidades */
        }

        .navbar a {
    color: #000; /* Cambia el color del texto a negro */
    text-decoration: none;
}


        .navbar .logo img {
            height: 40px;
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
            transform: scale(1.15);
        }

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
        .tema img {
            width: 100px; /* Ajusta este valor según tus necesidades */
            height: auto;
        }
    </style>
</head>
<body>
    <header class="navbar">
        <div class="left-buttons">
            <button type="button" onclick="window.location.href='nuevo_tema.php'">Agregar Nuevo Tema</button>
        </div>
        <button type="button" onclick="window.location.href='index.php'">comparar moviles</button>
        </div>
        <div class="logo">
            <img src="imagenes/logo.png" alt="Logo">
        </div>
        <div class="right-buttons">
            <?php if (isset($_SESSION["user_name"])): ?>
                <p>
                    <img src="imagenes/usuario.ico" alt="Usuario" height="30">
                    <?php echo htmlspecialchars($_SESSION["user_name"]); ?>
                </p>
                <a href="?logout">Cerrar sesión</a>
            <?php else: ?>
                <a href="login.php">Iniciar sesión</a>
            <?php endif; ?>
        </div>
    </header>

    <main class="container">
        <form action="foro.php" method="get">
            <input type="text" name="search" placeholder="Buscar por nombre">
            <button type="submit">Buscar</button>
        </form>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="tema">
                    <a href='tema.php?id=<?php echo htmlspecialchars($row["idtema_foro"]); ?>'>
                        <?php echo htmlspecialchars($row["titulo"]); ?>
                    </a>
                    <?php if (!empty($row["imagen"])): ?>
                        <img src="<?php echo htmlspecialchars($row["imagen"]); ?>" alt="Imagen del tema">
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No hay temas disponibles</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>Derechos reservados © 2024</p>
    </footer>
</body>
</html>