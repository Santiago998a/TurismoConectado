<?php
// guardar_itinerario.php
session_start();
include 'conexion.php';

// Verificar que el usuario esté logueado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.html");
    exit();
}

// Obtener datos del formulario
$id_usuario = $_SESSION['id_usuario'];  // asumimos que guardas el id de usuario en sesión
$ciudad = $_POST['ciudad'] ?? '';
$titulo = $_POST['titulo'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$fecha_inicio = $_POST['fecha_inicio'] ?? '';
$fecha_fin = $_POST['fecha_fin'] ?? '';

// Validar campos obligatorios
if (empty($ciudad) || empty($titulo) || empty($fecha_inicio) || empty($fecha_fin)) {
    echo "<script>alert('Por favor completa todos los campos obligatorios.'); window.history.back();</script>";
    exit();
}

// Preparar e insertar en la base de datos
$sql = "INSERT INTO itinerarios (id_usuario, ciudad, titulo, descripcion, fecha_inicio, fecha_fin) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("isssss", $id_usuario, $ciudad, $titulo, $descripcion, $fecha_inicio, $fecha_fin);

if ($stmt->execute()) {
    header("Location: itinerarios.php");  // o la página donde muestras itinerarios
    exit();
} else {
    echo "<script>alert('Error al guardar el itinerario.'); window.history.back();</script>";
}

$stmt->close();
$conexion->close();
?>
