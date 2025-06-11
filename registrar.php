<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "turismo_conectado");

// Establecer charset UTF-8
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Verificar que el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger datos del formulario de forma segura
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validación rápida
    if (empty($nombre) || empty($email) || empty($password)) {
        echo "Por favor completa todos los campos.";
        exit();
    }

    // Encriptar la contraseña
    $password_encriptada = password_hash($password, PASSWORD_DEFAULT);

    // Usar consulta preparada para evitar inyección SQL
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo, contraseña) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $email, $password_encriptada);

    if ($stmt->execute()) {
        // Registro exitoso: redirigir al home
        header("Location: home.php");
        exit();
    } else {
        echo "<strong>Error al insertar:</strong><br>";
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conexion->close();
?>
