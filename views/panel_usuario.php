<?php
// Inicio de sesión y control de acceso: si no hay usuario logueado, redirige a la página de inicio
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: /TFG/views/home.php");
    exit;
}

// Incluye el encabezado común con navegación y configuración global
require_once __DIR__ . '/header.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <!-- Configuración general de la página -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Panel del Usuario</title>

  <!-- Recursos externos: Bootstrap, íconos y hoja de estilos personalizada -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="/TFG/views/style.css" />
</head>
<body>

<!-- Sección principal del panel -->
<section class="container-xl my-5">
  <h2 class="text-center mb-4">Panel de Usuario</h2>

  <!-- Mensaje personalizado con el nombre del usuario logueado -->
  <p class="text-center">Hola, <?= htmlspecialchars($_SESSION['nombre']) ?>. Desde aquí puedes gestionar tu perfil y datos familiares.</p>

  <!-- Contenedor de tarjetas con funcionalidades del usuario -->
  <div class="row g-4">

    <!-- Tarjeta: Editar perfil -->
    <div class="col-md-6">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Editar Perfil</h5>
          <p class="card-text">Actualiza tu nombre, correo o contraseña.</p>
          <a href="/TFG/views/editar_perfil.php" class="btn btn-primary w-40">Editar Perfil</a>
        </div>
      </div>
    </div>

    <!-- Tarjeta: Gestión de hijos -->
    <div class="col-md-6">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Gestión de Hijos/as</h5>
          <p class="card-text">Añade, modifica o elimina las fechas de nacimiento de tus hijos.</p>
          <a href="/TFG/views/gestionar_hijos.php" class="btn btn-primary w-40">Gestionar Hijos</a>
        </div>
      </div>
    </div>

    <!-- Tarjeta: Ver calendario vacunal -->
    <div class="col-md-6">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Mi Calendario Vacunal</h5>
          <p class="card-text">Consulta recordatorios automáticos según las fechas de nacimiento registradas.</p>
          <a href="/TFG/controllers/calendarioUsuarioController.php" class="btn btn-primary w-40">Ver Calendario</a>
        </div>
      </div>
    </div>

    <!-- Tarjeta: Eliminar cuenta -->
    <div class="col-md-6">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Eliminar Cuenta</h5>
          <p class="card-text">Si lo deseas, puedes eliminar tu cuenta y todos los datos asociados.</p>
          <a href="/TFG/controllers/eliminarCuentaController.php"
             onclick="return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.');"
             class="btn btn-danger w-40">
             Eliminar Cuenta
          </a>
        </div>
      </div>
    </div>

  </div> <!-- Fin del row -->
</section>

<!-- Script de Bootstrap para componentes interactivos -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
// Incluye el pie de página del sitio
require_once __DIR__ . '/footer.php';
?>
