<?php
// Inicia la sesión si no está iniciada ya
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluye el modelo de base de datos
require_once __DIR__ . '/../models/BBDD.php';

// Si el usuario no ha iniciado sesión, lo redirige a la página de inicio
if (!isset($_SESSION['id'])) {
    header('Location: /TFG/index.php');
    exit;
}

// Crea instancia de la base de datos y obtiene los hijos del usuario actual
$db = new BBDD();
$usuarioId = (int) $_SESSION['id'];
$hijos = $db->obtenerHijosPorUsuario($usuarioId);
?>

<?php
// Incluye el header común del sitio
require_once __DIR__ . '/header.php';
?>

<section class="container my-5">
  <h2 class="text-center mb-4">Gestión de Hijos/as</h2>

  <!-- Muestra mensajes de éxito si hay acciones realizadas -->
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
    <!-- Muestra mensajes de error si hay fallos en alguna acción -->
    <div class="alert alert-danger text-center">
      <?= match ($_GET['error']) {
        'fecha_invalida' => '❌ La fecha introducida no es válida.',
        'no_encontrado' => '❌ No se pudo eliminar el hijo/a.',
        'actualizacion_parcial' => '⚠️ Algunas fechas no se actualizaron por formato inválido.',
        default => '❌ Ha ocurrido un error inesperado.'
      }; ?>
    </div>
  <?php endif; ?>

  <!-- Formulario principal para editar o añadir fechas -->
  <form method="POST" action="/TFG/controllers/gestionarHijosController.php" class="mx-auto" style="max-width: 600px;">
    
    <?php if (!empty($hijos)): ?>
      <h4 class="mb-3">Hijos registrados:</h4>
      
      <!-- Itera por cada hijo y muestra un input con su fecha de nacimiento -->
      <?php foreach ($hijos as $hijo): ?>
        <div class="input-group mb-3">
          <input type="date" name="fechas[<?= $hijo['id'] ?>]" class="form-control"
                 value="<?= htmlspecialchars($hijo['fecha_nacimiento']) ?>" required>
          <!-- Botón para eliminar al hijo correspondiente -->
          <button type="submit" name="eliminar_id" value="<?= $hijo['id'] ?>" class="btn btn-danger">Eliminar</button>
        </div>
      <?php endforeach; ?>

      <!-- Botón para guardar todas las modificaciones -->
      <button type="submit" class="btn btn-primary mb-4">Guardar Cambios</button>

    <?php else: ?>
      <!-- Mensaje si el usuario aún no ha registrado hijos -->
      <div class="alert alert-secondary text-center">No has registrado ningún hijo aún.</div>
    <?php endif; ?>

    <hr>

    <!-- Sección para añadir una nueva fecha de nacimiento -->
    <h4 class="mb-3">Añadir nueva fecha de nacimiento:</h4>
    <div class="input-group mb-3">
      <input type="date" name="nueva_fecha" class="form-control">
      <button type="submit" class="btn btn-success">Añadir</button>
    </div>
  </form>
</section>

<?php
// Incluye el footer común
require_once __DIR__ . '/footer.php';
?>
