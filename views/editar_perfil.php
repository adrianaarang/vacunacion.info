<?php
session_start();
require_once __DIR__ . '/../views/header.php';

// Redirigir si el usuario no está logueado
if (!isset($_SESSION['id'])) {
    header('Location: /views/home.php');
    exit;
}
?>

<section class="container my-5">
  <?php if (isset($_GET['actualizado']) && $_GET['actualizado'] == 1): ?>
    <div class="alert alert-success text-center">
      Perfil actualizado correctamente. ¡Hola de nuevo, <?= htmlspecialchars($_SESSION['nombre']) ?>!
    </div>
  <?php endif; ?>

  <h2 class="text-center mb-4">Editar Perfil</h2>
  <form action="/controllers/editarPerfilController.php" method="POST" class="mx-auto" style="max-width: 600px;">

    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" required value="<?= htmlspecialchars($_SESSION['nombre']) ?>">
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Correo electrónico</label>
      <input type="email" class="form-control" id="email" name="email" required value="<?= htmlspecialchars($_SESSION['email']) ?>">
    </div>

    <div class="mb-3">
      <label for="nueva_password" class="form-label">Nueva contraseña (opcional)</label>
      <input type="password" class="form-control" id="nueva_password" name="nueva_password" placeholder="Deja en blanco si no deseas cambiarla">
    </div>

    <button type="submit" class="btn btn-primary">Guardar cambios</button>
    <a href="/views/panel_usuario.php" class="btn btn-secondary ms-2">Cancelar</a>
  </form>
</section>

<?php require_once __DIR__ . '/../views/footer.php'; ?>
