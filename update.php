<?php
session_start(); // Iniciar la sesión

include 'conexion.php';

// Recoger los datos del formulario
$modelo = $mysqli->real_escape_string($_POST['modelo']);
$tamaño_pantalla = $mysqli->real_escape_string($_POST['tamaño_pantalla']);
$almacenamiento = $mysqli->real_escape_string($_POST['almacenamiento']);
$tipo_almacenamiento = $mysqli->real_escape_string($_POST['tipo_almacenamiento']);
$ram = $mysqli->real_escape_string($_POST['ram']);
$tipo_ram = $mysqli->real_escape_string($_POST['tipo_ram']);
$can_principal = $mysqli->real_escape_string($_POST['can_principal']);
$resolucion_principal = $mysqli->real_escape_string($_POST['resolucion_principal']);
$can_gran = $mysqli->real_escape_string($_POST['can_gran']);
$resolucion_gran = $mysqli->real_escape_string($_POST['resolucion_gran']);
$can_tele = $mysqli->real_escape_string($_POST['can_tele']);
$resolucion_tele = $mysqli->real_escape_string($_POST['resolucion_tele']);
$can_macro = $mysqli->real_escape_string($_POST['can_macro']);
$resolucion_macro = $mysqli->real_escape_string($_POST['resolucion_macro']);
$bateria = $mysqli->real_escape_string($_POST['bateria']);
$precio = $mysqli->real_escape_string($_POST['precio']);
$descripcion = $mysqli->real_escape_string($_POST['descripcion']);
$nombre_os = $mysqli->real_escape_string($_POST['nombre_os']);
$resolucion = $mysqli->real_escape_string($_POST['resolucion']);
$tecnologia = $mysqli->real_escape_string($_POST['tecnologia']);

// Crear la consulta SQL para actualizar los datos
$sql = "UPDATE movil SET modelo='$modelo', tamaño_pantalla='$tamaño_pantalla', almacenamiento='$almacenamiento', tipo_almacenamiento='$tipo_almacenamiento', ram='$ram', tipo_ram='$tipo_ram', can_principal='$can_principal', resolucion_principal='$resolucion_principal', can_gran='$can_gran', resolucion_gran='$resolucion_gran', can_tele='$can_tele', resolucion_tele='$resolucion_tele', can_macro='$can_macro', resolucion_macro='$resolucion_macro', bateria='$bateria', precio='$precio', descripcion='$descripcion', nombre_os='$nombre_os', resolucion='$resolucion', tecnologia='$tecnologia' WHERE idmovil = $idmovil";

// Ejecutar la consulta
if ($mysqli->query($sql) === TRUE) {
    echo "Registro actualizado con éxito";
} else {
    echo "Error al actualizar el registro: " . $mysqli->error;
}

// Cerrar la conexión
$mysqli->close();
?>
