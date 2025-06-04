<?php
// Inicia la sesión para acceder a los datos del usuario
session_start();

// Incluye el header común del sitio
require_once __DIR__ . '/../views/header.php';

// Si el usuario no ha iniciado sesión, lo redirige al home
if (!isset($_SESSION['id'])) {
    header('Location: /TFG/views/home.php');
    exit;
}
?>

<!-- Contenedor principal -->
<section class="container my-5">
  
  <!-- Mensaje de éxito si los datos se actualizaron -->
  <?php if (isset($_GET['actualizado']) && $_GET['actualizado'] == 1): ?>
    <div class="alert alert-success text-center">
      Perfil actualizado correctamente. ¡Hola de nuevo, <?= htmlspecialchars($_SESSION['nombre']) ?>!
    </div>
  <?php endif; ?>

  <!-- Título de la sección -->
  <h2 class="text-center mb-4">Editar Perfil</h2>

  <!-- Formulario de edición de perfil -->
  <form action="/TFG/controllers/editarPerfilController.php" method="POST" class="mx-auto" style="max-width: 600px;">
    
    <!-- Campo para editar el nombre -->
    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" required value="<?= htmlspecialchars($_SESSION['nombre']) ?>">
    </div>

    <!-- Campo para editar el correo electrónico -->
    <div class="mb-3">
      <label for="email" class="form-label">Correo electrónico</label>
      <input type="email" class="form-control" id="email" name="email" required value="<?= htmlspecialchars($_SESSION['email']) ?>">
    </div>

    <!-- Campo opcional para cambiar la contraseña -->
    <div class="mb-3">
      <label for="nueva_password" class="form-label">Nueva contraseña (opcional)</label>
      <input type="password" class="form-control" id="nueva_password" name="nueva_password" placeholder="Deja en blanco si no deseas cambiarla">
    </div>

    <!-- Botón para guardar y botón para cancelar -->
    <button type="submit" class="btn btn-primary">Guardar cambios</button>
    <a href="/TFG/views/panel_usuario.php" class="btn btn-secondary ms-2">Cancelar</a>
  </form>
</section>

<!-- Incluye el pie de página del sitio -->
<?php require_once __DIR__ . '/../views/footer.php'; ?>
