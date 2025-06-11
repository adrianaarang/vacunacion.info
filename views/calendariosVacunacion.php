<?php
require_once __DIR__ . '/header.php';
require_once __DIR__ . '/../controllers/pintarVacunasComunidad.php';
?>

<section class="container my-5">
  <h2 class="section-header mb-4 text-center">Consulta el calendario por comunidad</h2>
  <form action="calendariosVacunacion.php" method="GET" class="row justify-content-center">
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
</section>

<?php if (isset($_GET['comunidad'])): ?>
  <?php
    $idSeleccionado = $_GET['comunidad'];
    foreach ($comunidades as $comunidad):
      if ($comunidad['id'] == $idSeleccionado):
  ?>
    <section class="container text-center my-5">
      <h3 class="mb-4">Calendario de vacunación para <?= htmlspecialchars($comunidad['nombre']) ?></h3>
      <img src="/views/<?= htmlspecialchars($comunidad['foto_calendario']) ?>" class="img-fluid" alt="Calendario de <?= htmlspecialchars($comunidad['nombre']) ?>">
    </section>
  <?php
        break;
      endif;
    endforeach;
  ?>
<?php endif; ?>

<?php require_once __DIR__ . '/footer.php'; ?>
