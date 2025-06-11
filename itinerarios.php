<?php
session_start();
if (!isset($_SESSION['correo'])) {
    header("Location: login.html");
    exit;
}

include 'conexion.php';

$correo = $_SESSION['correo'];
$nombre = $_SESSION['nombre'];

// Obtener ID del usuario
$stmt = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ?");
$stmt->bind_param("s", $correo);
$stmt->execute();
$id_usuario = $stmt->get_result()->fetch_assoc()['id'];
$stmt->close();

// Insertar itinerario si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ciudad       = trim($_POST['ciudad'] ?? '');
    $fecha_inicio = $_POST['fecha_inicio'] ?? '';
    $fecha_fin    = $_POST['fecha_fin'] ?? '';
    $titulo  = trim($_POST['titulo'] ?? '');
    $descripcion  = trim($_POST['descripcion'] ?? '');

    if ($ciudad && $fecha_inicio && $fecha_fin && $titulo && $descripcion) {
        $insert = $conexion->prepare("
            INSERT INTO itinerarios 
              (id_usuario, ciudad, fecha_inicio, fecha_fin, titulo, descripcion) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $insert->bind_param("isssss", $id_usuario, $ciudad, $fecha_inicio, $fecha_fin, $titulo, $descripcion);
        $insert->execute();
        $insert->close();

        // Evitar reenvío de formulario
        header("Location: itinerarios.php");
        exit;
    }
}

// Eliminar itinerario
if (isset($_GET['eliminar'])) {
    $id_eliminar = (int)$_GET['eliminar'];
    $delete = $conexion->prepare("
        DELETE FROM itinerarios 
        WHERE id = ? AND id_usuario = ?
    ");
    $delete->bind_param("ii", $id_eliminar, $id_usuario);
    $delete->execute();
    $delete->close();

    header("Location: itinerarios.php");
    exit;
}

// Obtener itinerarios del usuario
$stmt = $conexion->prepare("
    SELECT id, ciudad, fecha_inicio, fecha_fin, titulo, descripcion
    FROM itinerarios
    WHERE id_usuario = ?
    ORDER BY fecha_inicio DESC
");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$itinerarios = $stmt->get_result();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mis Itinerarios – Turismo Conectado</title>
  <link href="bootstrap-5.3.5-dist/bootstrap-5.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <header class="bg-primary text-white py-4 mb-5">
    <div class="container text-center">
      <h1>Mis Itinerarios</h1>
      <p>Hola, <?= htmlspecialchars($nombre) ?></p>
    </div>
  </header>

  <main class="container">

    <!-- Formulario para agregar nuevo itinerario -->
    <div class="card shadow p-4 mb-5 bg-white">
      <h4 class="text-primary mb-3">Agregar nuevo itinerario</h4>
      <form method="post" class="row g-3">
        <div class="col-md-3">
          <input type="text" name="ciudad" class="form-control" placeholder="Ciudad" required>
        </div>
        <div class="col-md-3">
          <input type="date" name="fecha_inicio" class="form-control" required>
        </div>
        <div class="col-md-3">
          <input type="date" name="fecha_fin" class="form-control" required>
        </div>
        <div class="col-md-2">
          <input type="text" name="titulo" class="form-control" placeholder="Titulo" required>
        </div>
        <div class="col-md-2">
          <input type="text" name="descripcion" class="form-control" placeholder="Descripción" required>
        </div>
        <div class="col-md-1 d-grid">
          <button type="submit" class="btn btn-success">+</button>
        </div>
      </form>
    </div>

    <!-- Tabla de itinerarios -->
    <?php if ($itinerarios->num_rows): ?>
    <div class="card shadow p-4 bg-white">
      <h4 class="text-primary mb-3">Tus Itinerarios</h4>
      <div class="table-responsive">
        <table class="table table-striped align-middle">
          <thead class="table-primary">
            <tr>
              <th>Ciudad</th>
              <th>Inicio</th>
              <th>Fin</th>
              <th>Descripción</th>
              <th>Titulo</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $itinerarios->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['ciudad']) ?></td>
              <td><?= htmlspecialchars($row['fecha_inicio']) ?></td>
              <td><?= htmlspecialchars($row['fecha_fin']) ?></td>
              <td><?= htmlspecialchars($row['titulo']) ?></td>
              <td><?= htmlspecialchars($row['descripcion']) ?></td>
              <td>
                <a href="itinerarios.php?eliminar=<?= $row['id'] ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('¿Eliminar este itinerario?')">
                  ✕
                </a>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
    <?php else: ?>
      <p class="text-center">No tienes itinerarios aún. ¡Agrega tu primero!</p>
    <?php endif; ?>

    <div class="text-center mt-5">
      <a href="home.php" class="btn btn-outline-primary me-2">Volver a Home</a>
      <a href="pantalla_principal.html" class="btn btn-outline-secondary">Cerrar sesión</a>
    </div>

  </main>

  <script src="bootstrap-5.3.5-dist/bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>