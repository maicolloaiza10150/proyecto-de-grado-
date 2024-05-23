<?php
// Obtener los IDs de los teléfonos seleccionados
$phones = $_POST["phones"];

// Realizar una consulta SQL para obtener los datos de los teléfonos seleccionados
// y mostrar las especificaciones lado a lado en una tabla
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Aquí va el resto de tu código HTML para el encabezado de la página -->
</head>
<body>
    <div class="container">
        <h1>Comparación de Teléfonos</h1>
        <table class="comparison-table">
            <tr>
                <th>Especificación</th>
                <?php
                foreach ($phones as $phone_id) {
                    // Aquí deberías obtener el nombre del teléfono
                    echo "<th>Nombre del Teléfono</th>";
                }
                ?>
            </tr>
            <!-- Aquí deberías mostrar las especificaciones de cada teléfono -->
        </table>
    </div>
</body>
</html>
