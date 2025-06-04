<?php require_once 'header.php'; ?> <!-- Carga el encabezado común del sitio -->

<!DOCTYPE html>
<html lang="es">
<head>
  <!-- Metadatos básicos -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendario de Vacunación</title>

  <!-- Estilos externos: Bootstrap, íconos y estilos personalizados -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="/TFG/views/style.css">

  <!-- Estilos adicionales para los badges de financiación -->
  <style>
    .badge-financiada { background-color: #198754; } /* Verde para financiadas */
    .badge-no-financiada { background-color: #ffc107; color: #212529; } /* Amarillo oscuro para no financiadas */
  </style>
</head>
<body>

<!-- Sección principal -->
<section class="container-xl my-5">
  <h2 class="text-center mb-4">Calendario de Vacunación Personalizado</h2>
  <p class="text-center">Visualiza las fechas previstas para las vacunas de tus hijos.</p>

  <!-- Si hay eventos programados, mostramos tabla -->
  <?php if (!empty($eventos)): ?>

    <!-- Filtro por hijo/a -->
    <form method="GET" class="mb-4 text-center">
      <label for="hijo_id" class="form-label me-2">Filtrar por hijo/a:</label>
      <select name="hijo_id" id="hijo_id" class="form-select d-inline w-auto" onchange="this.form.submit()">
        <option value="">Todos</option>
        <?php foreach ($hijos as $index => $hijo): ?>
          <option value="<?= $hijo['id'] ?>" <?= isset($_GET['hijo_id']) && $_GET['hijo_id'] == $hijo['id'] ? 'selected' : '' ?>>
            Hijo/a <?= $index + 1 ?> - <?= date('d/m/Y', strtotime($hijo['fecha_nacimiento'])) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </form>

    <!-- Tabla de eventos -->
    <table class="table table-bordered mt-4">
      <thead class="table-light">
        <tr>
          <th>Fecha</th>
          <th>Vacuna</th>
          <th>Descripción</th>
          <th>Financiación</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($eventos as $evento): ?>
          <tr>
            <td><?= date('d/m/Y', strtotime($evento['start'])) ?></td>
            <td><strong><?= htmlspecialchars($evento['title']) ?></strong></td>
            <td><?= htmlspecialchars($evento['description']) ?></td>
            <td>
              <!-- Badge de color según financiación -->
              <span class="badge <?= $evento['color'] === '#198754' ? 'badge-financiada' : 'badge-no-financiada' ?>">
                <?= $evento['color'] === '#198754' ? 'Financiada' : 'No financiada' ?>
              </span>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

  <?php else: ?>
    <!-- Mensaje si no hay eventos -->
    <p class="text-center">No se han encontrado vacunas programadas para tus hijos.</p>
  <?php endif; ?>

  <!-- Botón para volver -->
  <div class="text-center mt-4">
    <a href="/TFG/views/panel_usuario.php" class="btn btn-primary">Volver al Panel</a>
  </div>
</section>

<!-- Script de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php require_once 'footer.php'; ?> <!-- Pie de página común -->
