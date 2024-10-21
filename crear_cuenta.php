<?php 
require_once "config/conexion.php"; 
require_once "config/config.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Recoger datos del formulario 
    $nombre = $_POST['nombre']; 
    $usuario = $_POST['usuario']; 
    $clave = password_hash($_POST['clave'], PASSWORD_DEFAULT); // Hash de la contraseña 
    $email = $_POST['email']; 
    $telefono = $_POST['telefono']; 
    $direccion = $_POST['direccion']; 

    // Consulta para insertar el nuevo usuario 
    $sql = "INSERT INTO usuarios_clientes (nombre, usuario, clave, email, telefono, direccion) 
            VALUES (?, ?, ?, ?, ?, ?)"; 

    if ($stmt = $conexion->prepare($sql)) { 
        // Vincular variables 
        $stmt->bind_param("ssssss", $nombre, $usuario, $clave, $email, $telefono, $direccion); 

        // Ejecutar la consulta 
        if ($stmt->execute()) { 
            echo "Cuenta creada exitosamente."; 
        } else { 
            echo "Error: " . $stmt->error; 
        } 
    } else { 
        echo "Error al preparar la consulta: " . $conexion->error; 
    } 

    // Cerrar la declaración y la conexión 
    $stmt->close(); 
    $conexion->close(); 
} 
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta</title>
    <link href="assets/css/styles.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <h2>Crear Cuenta</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" class="form-control" name="usuario" required>
            </div>
            <div class="mb-3">
                <label for="clave" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" name="clave" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="text" class="form-control" name="telefono" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección:</label>
                <input type="text" class="form-control" name="direccion" required>
            </div>
            <button type="submit" class="btn btn-primary">Crear Cuenta</button>
        </form>
    </div>
</body>

</html>
