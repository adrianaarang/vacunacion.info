<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/BBDD.php';

if (!isset($_SESSION['id'])) {
    header('Location: /index.php');
    exit;
}

$db = new BBDD();
$usuarioId = (int) $_SESSION['id'];
$hijos = $db->obtenerHijosPorUsuario($usuarioId);
?>

<?php require_once __DIR__ . '/header.php'; ?>

<section class="container my-5">
  <h2 class="text-center mb-4">Gestión de Hijos/as</h2>

  <?php if (!empty($_GET['accion'])): ?>
    <div class="alert alert-success text-center">
      <?= match ($_GET['accion']) {
        'anadido' => '✅ Fecha añadida correctamente.',
        'eliminado' => '✅ Hijo/a eliminado correctamente.',
        'actualizado' => '✅ Fechas actualizadas correctamente.',
        default => '✅ Acción completada.'
      }; ?>
    </div>
  <?php elseif (!empty($_GET['error'])): ?>
    <div class="alert alert-danger text-center">
      <?= match ($_GET['error']) {
        'fecha_invalida' => '❌ La fecha introducida no es válida.',
        'no_encontrado' => '❌ No se pudo eliminar el hijo/a.',
        'actualizacion_parcial' => '⚠️ Algunas fechas no se actualizaron por formato inválido.',
        default => '❌ Ha ocurrido un error inesperado.'
      }; ?>
    </div>
  <?php endif; ?>

  <form method="POST" action="/controllers/gestionarHijosController.php" class="mx-auto" style="max-width: 600px;">
    <?php if (!empty($hijos)): ?>
      <h4 class="mb-3">Hijos registrados:</h4>
      <?php foreach ($hijos as $hijo): ?>
        <div class="input-group mb-3">
          <input type="date" name="fechas[<?= $hijo['id'] ?>]" class="form-control"
                 value="<?= htmlspecialchars($hijo['fecha_nacimiento']) ?>" required>
          <button type="submit" name="eliminar_id" value="<?= $hijo['id'] ?>" class="btn btn-danger">Eliminar</button>
        </div>
      <?php endforeach; ?>
      <button type="submit" class="btn btn-primary mb-4">Guardar Cambios</button>
    <?php else: ?>
      <div class="alert alert-secondary text-center">No has registrado ningún hijo aún.</div>
    <?php endif; ?>

    <hr>
    <h4 class="mb-3">Añadir nueva fecha de nacimiento:</h4>
    <div class="input-group mb-3">
      <input type="date" name="nueva_fecha" class="form-control">
      <button type="submit" class="btn btn-success">Añadir</button>
    </div>
  </form>
</section>

<?php require_once __DIR__ . '/footer.php'; ?>
