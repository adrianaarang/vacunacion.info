<?php
session_start();

// Solo permitir acceso si es administrador
if (!isset($_SESSION['email']) || $_SESSION['email'] !== 'administrador@vacunacion.info') {
    header("Location: /views/home.php");
    exit;
}

require_once __DIR__ . '/header.php';
?>

<section class="container-xl my-5">
  <div class="text-center mb-4">
    <h2 class="titulo-principal">Panel de Administración</h2>
    <p class="lead">Bienvenido, administrador. Desde aquí puedes gestionar el contenido de la plataforma.</p>
  </div>

  <div class="row g-4">

    <!-- Gestión de Vacunas -->
    <div class="col-md-6">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Gestión de Vacunas</h5>
          <p class="card-text">Añade, edita o elimina vacunas y sus descripciones</p>
          <a href="/views/vacunas_gestion.php" class="btn btn-primary">Administrar Vacunas</a>
        </div>
      </div>
    </div>

    <!-- Gestión de Calendarios -->
    <div class="col-md-6">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Calendarios por Comunidad</h5>
          <p class="card-text">Gestiona los calendarios vacunales infantiles por comunidad</p>
          <a href="/views/gestionar_calendarios.php" class="btn btn-primary">Gestionar Calendarios</a>
        </div>
      </div>
    </div>

    <!-- Recordatorios Enviados -->
    <div class="col-md-6">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Recordatorios Enviados</h5>
          <p class="card-text">Consulta los correos de recordatorio enviados a los usuarios.</p>
          <a href="/views/recordatorios_enviados.php" class="btn btn-primary">Ver Recordatorios</a>
        </div>
      </div>
    </div>

    <!-- Gestión de Usuarios -->
    <div class="col-md-6">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Gestión de Usuarios</h5>
          <p class="card-text">Administra los usuarios registrados: Eliminar.</p>
          <a href="/views/usuarios_gestion.php" class="btn btn-primary">Administrar Usuarios</a>
        </div>
      </div>
    </div>

  </div>
</section>

<?php
require_once __DIR__ . '/footer.php';
?>
