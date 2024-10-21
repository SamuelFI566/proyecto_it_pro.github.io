<?php 
session_start(); 
if (!isset($_SESSION['usuario'])) { 
    header("Location: iniciar_sesion.php"); 
    exit(); 
} 
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link href="assets/css/styles.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <h2>Bienvenido, <?php echo $_SESSION['nombre']; ?>!</h2>
        <p>Has iniciado sesión con éxito.</p>
        <a href="cerrar_sesion.php" class="btn btn-danger">Cerrar Sesión</a>
    </div>
</body>

</html>
