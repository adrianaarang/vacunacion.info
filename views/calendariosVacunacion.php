
<?php
require_once __DIR__ . '/header.php';
require_once __DIR__ . '/../controllers/pintarVacunasComunidad.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Calendario Vacunación</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="/TFG/views/style.css">
</head>
<body>

<section class="container my-5">
  <h2 class="section-header mb-4 text-center">Consulta el calendario por comunidad</h2>
  <form action="/TFG/views/calendariosVacunacion.php" method="GET" class="row justify-content-center">
    <div class="col-md-6">
      <label for="comunidad" class="form-label">Selecciona tu comunidad autónoma:</label>
      <select id="comunidad" name="comunidad" class="form-select" required>
        <option value="" disabled selected>Elige una comunidad</option>
        <?php foreach ($comunidades as $comunidad): ?>
          <option value="<?= htmlspecialchars($comunidad['id']) ?>">
            <?= htmlspecialchars($comunidad['nombre']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-12 text-center mt-4">
      <button type="submit" class="btn btn-primary">Ver calendario</button>
    </div>
  </form>

  <div class="text-center mt-3">
    <img src="/TFG/views/bootstrap/img/logo/logo5.png" alt="Logo" class="img-fluid" style="max-width: 120px;">
  </div>
</section>

<?php
if (isset($_GET['comunidad'])) {
  $idSeleccionado = $_GET['comunidad'];
  foreach ($comunidades as $comunidad) {
    if ($comunidad['id'] == $idSeleccionado) {
      echo "<section class='container text-center my-5'>";
      echo "<h3 class='mb-4'>Calendario de vacunación para " . htmlspecialchars($comunidad['nombre']) . "</h3>";
      echo "<img src='/TFG/views/" . htmlspecialchars($comunidad['foto_calendario']) . "' class='img-fluid' alt='Calendario de " . htmlspecialchars($comunidad['nombre']) . "'>";
      echo "</section>";
      break;
    }
  }
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/TFG/views/javascript/login.js"></script>
<script src="/TFG/views/javascript/registro.js"></script>

</body>
</html>

<?php include __DIR__ . '/footer.php'; ?>
