<?php
// home.php
session_start();
if (!isset($_SESSION['correo'])) {
    header("Location: login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Turismo Conectado - Principal</title>
  <link rel="stylesheet" href="bootstrap-5.3.5-dist/bootstrap-5.3.5-dist/css/bootstrap.min.css"/>
</head>
<body class="bg-light">

  <header class="bg-primary text-white py-3">
    <div class="container text-center">
      <h1>Turismo Conectado</h1>
      <p>Descubre, explora y planifica tus viajes por las mejores ciudades</p>
    </div>
  </header>

  <main class="container mt-5 text-center">
    <h2 class="mb-4">Bienvenido a tu espacio personal</h2>
    <p class="lead">Selecciona una opción para comenzar a explorar</p>

    <div class="d-grid gap-3 col-6 mx-auto">
       <a href="explorar_ciudades.php" class="btn btn-primary btn-sm w-50 mx-auto">Explorar ciudades</a>
       <a href="itinerarios.php" class="btn btn-primary btn-sm w-50 mx-auto">Mi itinerario</a>
       <a href="admin.php" class="btn btn-primary btn-sm w-50 mx-auto">Panel de administración</a>
       <a href="pantalla_principal.html" class="btn btn-secondary btn-sm w-50 mx-auto">Cerrar sesión</a>
    </div>
  </main>

  <footer class="bg-dark text-white text-center py-3 mt-5">
    <p class="mb-0">&copy; 2025 Turismo Conectado - Todos los derechos reservados</p>
  </footer>

  <script src="bootstrap-5.3.5-dist/bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>