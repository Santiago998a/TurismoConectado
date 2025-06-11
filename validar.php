<?php
// validar.php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.html");
    exit;
}

$correo     = trim($_POST['correo'] ?? '');
$contrasena = $_POST['contrasena'] ?? '';

if ($correo === '' || $contrasena === '') {
    echo "<script>alert('Por favor completa todos los campos.'); window.location.href='login.html';</script>";
    exit;
}

// Buscamos al usuario junto con su rol
$sql  = "SELECT id, nombre, correo, contraseña AS hash, rol 
         FROM usuarios WHERE correo = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo "<script>alert('Correo no registrado.'); window.location.href='login.html';</script>";
    exit;
}

$user = $result->fetch_assoc();
$stmt->close();


#if ($contrasena !== $user['hash'])
if (!password_verify($contrasena, $user['hash'])) {
    echo "<script>alert('Contraseña incorrecta.'); window.location.href='login.html';</script>";
    exit;
}

// Guardar datos y rol en sesión
$_SESSION['id_usuario'] = $user['id'];
$_SESSION['nombre']     = $user['nombre'];
$_SESSION['correo']     = $user['correo'];
$_SESSION['rol']        = $user['rol'];  // <–– Aquí guardas el rol

header("Location: home.php");
exit;
?>