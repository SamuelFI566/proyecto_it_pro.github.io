<?php
$host = "localhost";
$user = "root";
$clave = "";
$bd = "card";

// Crear conexión
$conexion = mysqli_connect($host, $user, $clave, $bd);

// Verificar conexión
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>
