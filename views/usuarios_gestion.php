<?php 
require_once __DIR__ . '/header.php';
require_once __DIR__ . '/../models/BBDD.php';

$db = new BBDD();
$usuarios = array_filter($db->getUsuarios(), fn($u) => $u['email'] !== 'administrador@vacunacion.info');
?>

<section class="container-xl my-5">
  <h2 class="text-center mb-4">Gestión de Usuarios</h2>

  <?php if (isset($_GET['mensaje'])): ?>
    <div class="alert alert-<?= $_GET['mensaje'] === 'eliminado' ? 'success' : 'danger' ?> text-center">
      <?= $_GET['mensaje'] === 'eliminado' ? '✅ Usuario eliminado correctamente.' : '❌ Error al eliminar el usuario.' ?>
    </div>
  <?php endif; ?>

  <?php if (empty($usuarios)): ?>
    <div class="alert alert-secondary text-center">No hay usuarios registrados.</div>
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
        <?php foreach ($usuarios as $usuario): ?>
          <tr>
            <td><?= $usuario['id'] ?></td>
            <td><?= htmlspecialchars($usuario['nombre']) ?></td>
            <td><?= htmlspecialchars($usuario['email']) ?></td>
            <td>
              <form method="POST" action="/controllers/usuariosGestionController.php" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
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

<?php require_once __DIR__ . '/footer.php'; ?>
