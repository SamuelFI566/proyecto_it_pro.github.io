<?php 
session_start(); 
require_once "config/conexion.php"; 
require_once "config/config.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Recoger datos del formulario 
    $usuario = $_POST['usuario']; 
    $clave = $_POST['clave']; 

    // Consulta para obtener el usuario 
    $sql = "SELECT * FROM usuarios_clientes WHERE usuario = ?"; 

    if ($stmt = $conexion->prepare($sql)) { 
        $stmt->bind_param("s", $usuario); 

        // Ejecutar la consulta 
        $stmt->execute(); 
        $resultado = $stmt->get_result(); 

        if ($resultado->num_rows > 0) { 
            $fila = $resultado->fetch_assoc(); 

            // Verificar la contraseña 
            if (password_verify($clave, $fila['clave'])) { 
                // Iniciar sesión 
                $_SESSION['usuario'] = $fila['usuario']; 
                $_SESSION['nombre'] = $fila['nombre']; 
                header("Location: bienvenido.php"); // Redirigir a la página de bienvenida
                exit();
            } else { 
                echo "Contraseña incorrecta."; 
            } 
        } else { 
            echo "Usuario no encontrado."; 
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
    <title>Iniciar Sesión</title>
    <link href="assets/css/styles.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <h2>Iniciar Sesión</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" class="form-control" name="usuario" required>
            </div>
            <div class="mb-3">
                <label for="clave" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" name="clave" required>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
    </div>
</body>

</html>
