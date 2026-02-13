<?php
session_start();  // Inicia la sesión (necesario para utilizar variables de sesión)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Configuración de la conexión a la base de datos (igual que en el ejemplo de registro)
    $host = "localhost";
    $usuario = "root";
    $clave = "";
    $base_de_datos = "loginejemplo";

    $conexion = new mysqli($host, $usuario, $clave, $base_de_datos);

    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    // Prepara la consulta SQL para obtener la información del usuario
    $consulta = $conexion->prepare("SELECT id, nombre, email, password FROM usuarios WHERE email = ?");
    $consulta->bind_param("s", $email);
    $consulta->execute();
    $resultado = $consulta->get_result();
    $usuario = $resultado->fetch_assoc();

    // Verifica la contraseña
    if ($usuario && password_verify($password, $usuario["password"])) {
        // Inicio de sesión exitoso
        $_SESSION["usuario_id"] = $usuario["id"];
        $_SESSION["usuario_nombre"] = $usuario["nombre"];
        header("Location: bienvenido.php");  // Redirige a la página de bienvenida o donde desees
        exit();
    } else {
        // Credenciales incorrectas
        echo "Correo electrónico o contraseña incorrectos.";
    }

    // Cierra la conexión y la consulta
    $consulta->close();
    $conexion->close();
} else {
    // Redirigir o mostrar un mensaje de error si alguien intenta acceder a este script directamente.
    echo "Acceso no autorizado.";
}
?>