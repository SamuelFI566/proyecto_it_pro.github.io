<?php
require_once 'config/conexion.php'; // Asegúrate de incluir tu archivo de conexión

if (empty($_POST["usuario"]) || empty($_POST["password"])) {
    echo '<div class="alert alert-danger">LOS CAMPOS ESTÁN VACÍOS</div>';
} else {
    $usuario = $_POST["usuario"];
    $clave = $_POST["password"];

    // Usar prepared statements para evitar inyecciones SQL
    $stmt = $conexion->prepare("SELECT * FROM usuario WHERE usuario = ? AND clave = ?");
    $stmt->bind_param("ss", $usuario, $clave);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($datos = $resultado->fetch_object()) {
        header("Location: www/index.php"); // Redirigir a la página deseada
        exit(); // Asegúrate de salir después de redirigir
    } else {
        echo '<div class="alert alert-danger">ACCESO DENEGADO</div>';
    }

    $stmt->close(); // Cerrar el statement
}
?>
