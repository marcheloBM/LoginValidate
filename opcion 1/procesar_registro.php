<?php
// Verifica si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hashea la contraseña

    // Configuración de la conexión a la base de datos
    $host = "localhost";  // Cambia esto con la dirección de tu servidor de base de datos
    $usuario = "root";  // Cambia esto con tu nombre de usuario de la base de datos
    $clave = "";  // Cambia esto con tu contraseña de la base de datos
    $base_de_datos = "loginejemplo";  // Cambia esto con el nombre de tu base de datos

    // Conecta a la base de datos
    $conexion = new mysqli($host, $usuario, $clave, $base_de_datos);

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    // Prepara la consulta SQL para insertar el nuevo usuario
    $consulta = $conexion->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
    $consulta->bind_param("sss", $nombre, $email, $password);

    // Ejecuta la consulta
    if ($consulta->execute()) {
        echo "Registro exitoso. ¡Bienvenido, $nombre!";
		echo "<a href=\"$nombre\">Ir a Ejemplo</a>";
    } else {
        echo "Error al registrar usuario.";
    }

    // Cierra la conexión y la consulta
    $consulta->close();
    $conexion->close();
} else {
    // Redirigir o mostrar un mensaje de error si alguien intenta acceder a este script directamente.
    echo "Acceso no autorizado.";
}
?>