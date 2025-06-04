<?php 
// Incluyo el header común a toda la web
require_once __DIR__ . '/header.php';

// Incluyo el modelo de base de datos
require_once __DIR__ . '/../models/BBDD.php';

// Creo una instancia de la base de datos
$db = new BBDD();

// Obtengo todos los usuarios y excluyo el usuario administrador
$usuarios = array_filter($db->getUsuarios(), fn($u) => $u['email'] !== 'administrador@vacunacion.info');
?>

<section class="container-xl my-5">
  <!-- Título de la sección -->
  <h2 class="text-center mb-4">Gestión de Usuarios</h2>

  <!-- Mensaje de alerta si se ha pasado un mensaje por la URL -->
  <?php if (isset($_GET['mensaje'])): ?>
    <div class="alert alert-<?= $_GET['mensaje'] === 'eliminado' ? 'success' : 'danger' ?> text-center">
      <?= $_GET['mensaje'] === 'eliminado' ? 'Usuario eliminado correctamente.' : 'Error al eliminar el usuario.' ?>
    </div>
  <?php endif; ?>

  <!-- Mensaje si no hay usuarios registrados -->
  <?php if (empty($usuarios)): ?>
    <div class="alert alert-secondary text-center">No hay usuarios registrados.</div>
  
  <!-- Tabla de usuarios -->
  <?php else: ?>
    <table class="table table-bordered table-striped">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <!-- Recorro el array de usuarios y muestro cada uno en una fila -->
        <?php foreach ($usuarios as $usuario): ?>
          <tr>
            <td><?= $usuario['id'] ?></td>
            <td><?= htmlspecialchars($usuario['nombre']) ?></td>
            <td><?= htmlspecialchars($usuario['email']) ?></td>
            <td>
              <!-- Formulario para eliminar usuario -->
              <form method="POST" action="/TFG/controllers/usuariosGestionController.php" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                <input type="hidden" name="eliminar_id" value="<?= $usuario['id'] ?>">
                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</section>

<!-- Incluyo el footer común -->
<?php require_once __DIR__ . '/footer.php'; ?>
