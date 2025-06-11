<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Turismo Conectado - Nuevo Itinerario</title>
  <link rel="stylesheet" href="bootstrap-5.3.5-dist/bootstrap-5.3.5-dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"/>
  <style>
    body {
      background: linear-gradient(135deg, #007bff 0%, #6c757d 100%);
      min-height: 100vh;
    }
    .card {
      border-radius: 1rem;
    }
    .form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }
  </style>
</head>
<body>

  <header class="bg-primary text-white py-4 shadow">
    <div class="container text-center">
      <h1 class="display-5 fw-bold">Turismo Conectado</h1>
      <p class="lead mb-0">Agrega tu próximo itinerario de viaje</p>
    </div>
  </header>

  <main class="container d-flex justify-content-center align-items-center mt-5">
    <div class="card shadow p-4 w-100" style="max-width: 500px;">
      <h2 class="mb-4 text-center text-primary">Nuevo Itinerario</h2>

      <form action="guardar_itinerario.php" method="post" novalidate>
        <div class="mb-3">
          <label for="ciudad" class="form-label">Ciudad <span class="text-danger">*</span></label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-geo-alt-fill"></i></span>
            <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad que visitarás" required>
          </div>
        </div>

        <div class="mb-3">
          <label for="titulo" class="form-label">Título <span class="text-danger">*</span></label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-card-text"></i></span>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título del itinerario" required>
          </div>
        </div>

        <div class="mb-3">
          <label for="descripcion" class="form-label">Descripción</label>
          <textarea class="form-control" id="descripcion" name="descripcion" rows="4" placeholder="Descripción detallada"></textarea>
        </div>

        <div class="mb-3">
          <label for="fecha_inicio" class="form-label">Fecha de inicio <span class="text-danger">*</span></label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-calendar-check-fill"></i></span>
            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
          </div>
        </div>

        <div class="mb-3">
          <label for="fecha_fin" class="form-label">Fecha de fin <span class="text-danger">*</span></label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-calendar-x-fill"></i></span>
            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
          </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 mt-3">Guardar Itinerario</button>
      </form>

      <p class="text-center mt-3 mb-0">
        <a href="home.html" class="text-decoration-none">Volver al Inicio</a>
      </p>
    </div>
  </main>

  <footer class="bg-dark text-white text-center py-3 mt-5">
    <p class="mb-0">&copy; 2025 Turismo Conectado - Todos los derechos reservados</p>
  </footer>

  <script src="bootstrap-5.3.5-dist/bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>