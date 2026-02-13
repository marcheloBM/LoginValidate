<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["usuario_id"]) || !isset($_SESSION["usuario_nombre"])) {
    // Si no ha iniciado sesión, redirige al usuario al formulario de inicio de sesión
    header("Location: login.html");
    exit();
}

// Obtener información del usuario desde la sesión
$usuarioId = $_SESSION["usuario_id"];
$usuarioNombre = $_SESSION["usuario_nombre"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <!-- Agrega estilos CSS aquí si es necesario -->
</head>
<body>

<h2>Bienvenido, <?php echo $usuarioNombre; ?>!</h2>

<p>¡Has iniciado sesión con éxito!</p>

<a href="cerrar_sesion.php">Cerrar Sesión</a>

</body>
</html>