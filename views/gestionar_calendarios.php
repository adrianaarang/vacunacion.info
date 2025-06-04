<?php
// Incluye el header común con navegación y configuración general
require_once __DIR__ . '/header.php';

// Carga el controlador que obtiene los datos de las comunidades y maneja la lógica de subida/eliminación
require_once __DIR__ . '/../controllers/gestionarCalendariosController.php';
?>

<!-- Contenedor principal -->
<div class="container-xl my-5">
  <h2 class="text-center mb-4">Gestión de Calendarios por Comunidad</h2>

  <!-- Muestra mensaje de éxito o error si existe -->
  <?php if (!empty($mensaje)): ?>
    <div class="alert alert-<?= $mensaje['tipo'] ?> text-center">
      <?= htmlspecialchars($mensaje['texto']) ?>
    </div>
  <?php endif; ?>

  <!-- Grid de tarjetas por comunidad autónoma -->
  <div class="row">
    <?php foreach ($comunidades as $comunidad): ?>
      <div class="col-12 col-md-6 col-lg-4 mb-4">
        <div class="card h-100 shadow">
          
          <!-- Cabecera con el nombre de la comunidad -->
          <div class="card-header fw-bold"><?= htmlspecialchars($comunidad['nombre']) ?></div>
          
          <div class="card-body text-center">
            <?php if (!empty($comunidad['ruta_imagen'])): ?>
              <!-- Muestra la imagen si existe -->
              <img src="/TFG/views/<?= $comunidad['ruta_imagen'] ?>" alt="Calendario" class="img-fluid mb-3" style="max-height: 200px; object-fit: contain;">

              <!-- Botón para eliminar imagen -->
              <form method="post" class="mb-2">
                <input type="hidden" name="comunidad_id" value="<?= $comunidad['id'] ?>">
                <button type="submit" name="eliminar" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta imagen?')">
                  Eliminar imagen
                </button>
              </form>
            <?php else: ?>
              <!-- Mensaje si no hay imagen -->
              <p class="text-muted">No hay imagen subida</p>
            <?php endif; ?>

            <!-- Formulario para subir o actualizar la imagen de calendario -->
            <form method="post" enctype="multipart/form-data">
              <input type="hidden" name="comunidad_id" value="<?= $comunidad['id'] ?>">
              <input type="file" name="nueva_imagen" accept="image/*" required class="form-control mb-2">
              <button type="submit" name="actualizar" class="btn btn-primary btn-sm">Actualizar imagen</button>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Botón para volver al panel de administración -->
  <div class="text-center mt-4">
    <a href="/TFG/views/panel_admin.php" class="btn btn-primary">← Volver al Panel de Administración</a>
  </div>
</div>

<?php
// Incluye el footer común del sitio
require_once __DIR__ . '/footer.php';
?>
