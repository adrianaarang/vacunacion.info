<?php
session_start();
require_once __DIR__ . '/header.php';
require_once __DIR__ . '/../models/BBDD.php';

// Solo permito el acceso si el usuario está logueado como administrador
if (!isset($_SESSION['email']) || $_SESSION['email'] !== 'administrador@vacunacion.info') {
    header("Location: /TFG/index.php");
    exit;
}

// Me conecto a la base de datos y obtengo la lista de vacunas
$db = new BBDD();
$conn = $db->getConexion();
$vacunas = $conn->query("SELECT * FROM vacunas ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container my-5">
  <h2 class="mb-4 text-center">Gestión de Vacunas</h2>
  
  <?php if (isset($_GET['error']) && $_GET['error'] === 'duplicado'): ?>
    <!-- Muestro un mensaje si el código de vacuna ya está registrado -->
    <div class="alert alert-danger text-center">Ya existe una vacuna con ese código.</div>
  <?php endif; ?>

  <!-- Formulario para añadir una nueva vacuna -->
  <form action="/TFG/controllers/vacunasController.php" method="POST" class="mb-4 border p-3 rounded">
    <input type="hidden" name="accion" value="crear">
    <div class="row g-2">
      <div class="col-md-4">
        <input type="text" name="nombre" class="form-control" placeholder="Nombre de la vacuna" required>
      </div>
      <div class="col-md-4">
        <input type="text" name="codigo" class="form-control" placeholder="Código (opcional)">
      </div>
      <div class="col-md-4">
        <input type="text" name="descripcion" class="form-control" placeholder="Descripción" required>
      </div>
      <div class="col-12 text-end mt-2">
        <button type="submit" class="btn btn-primary">Añadir Vacuna</button>
      </div>
    </div>
  </form>

  <!-- Tabla que muestra las vacunas existentes con opciones de edición y eliminación -->
  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
      <thead class="table-primary text-center">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Código</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($vacunas as $v): ?>
          <tr>
            <!-- Formulario para editar los datos de la vacuna -->
            <form action="/TFG/controllers/vacunasController.php" method="POST">
              <input type="hidden" name="accion" value="editar">
              <input type="hidden" name="id" value="<?= $v['id'] ?>">
              <td class="text-center"><?= $v['id'] ?></td>
              <td><input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($v['nombre']) ?>"></td>
              <td><input type="text" name="descripcion" class="form-control" value="<?= htmlspecialchars($v['descripcion']) ?>"></td>
              <td><input type="text" name="codigo" class="form-control" value="<?= htmlspecialchars($v['codigo']) ?>"></td>
              <td class="text-center">
                <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
            </form>

            <!-- Formulario independiente para eliminar la vacuna -->
            <form action="/TFG/controllers/vacunasController.php" method="POST" class="d-inline">
              <input type="hidden" name="accion" value="eliminar">
              <input type="hidden" name="id" value="<?= $v['id'] ?>">
              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar vacuna?')">Eliminar</button>
            </form>
              </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Enlace para volver al panel de administración -->
  <div class="text-center mt-4">
    <a href="/TFG/views/panel_admin.php" class="btn btn-primary">← Volver al Panel</a>
  </div>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>
