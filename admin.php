<?php
// admin.php
session_start();

// 1) Verificar que esté logueado
if (!isset($_SESSION['correo'])) {
    header("Location: login.html");
    exit;
}

// 2) Verificar que sea administrador
if ($_SESSION['rol'] !== 'admin') {
    header("HTTP/1.1 403 Forbidden");
    exit("403 - Acceso denegado: no tienes permisos para ver esta página.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Panel de Administración – Turismo Conectado</title>
  <link rel="stylesheet" href="bootstrap-5.3.5-dist/bootstrap-5.3.5-dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"/>
</head>
<body class="bg-light">

  <header class="bg-primary text-white py-3">
    <div class="container text-center">
      <h1>Panel de Administración</h1>
      <p>Bienvenido, <?= htmlspecialchars($_SESSION['nombre']) ?> (<?= htmlspecialchars($_SESSION['rol']) ?>)</p>
    </div>
  </header>

  <main class="container mt-5">
    <div class="list-group">
      <a href="gestion_usuarios.php" class="list-group-item list-group-item-action">
        <i class="bi bi-people-fill"></i> Gestión de Usuarios
      </a>
      <a href="gestion_ciudades.php" class="list-group-item list-group-item-action">
        <i class="bi bi-building"></i> Gestión de Ciudades
      </a>
      <a href="gestion_itinerarios.php" class="list-group-item list-group-item-action">
        <i class="bi bi-card-list"></i> Gestión de Itinerarios
      </a>
      <!-- Añade aquí más módulos administrativos -->
    </div>

    <div class="mt-4">
      <a href="home.php" class="btn btn-outline-primary me-2">
        <i class="bi bi-house-door-fill"></i> Volver a Home
      </a>
      <a href="cerrar_sesion.php" class="btn btn-secondary">
        <i class="bi bi-box-arrow-right"></i> Cerrar sesión
      </a>
    </div>
  </main>

  <footer class="bg-dark text-white text-center py-3 mt-5">
    &copy; 2025 Turismo Conectado
  </footer>
</body>
</html>