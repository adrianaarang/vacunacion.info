<?php

require_once __DIR__ . '/header.php';
?>


<section class="container-xl my-5">
  <h2 class="text-center mb-4">Panel de Usuario</h2>
  <p class="text-center">Hola, <?= htmlspecialchars($_SESSION['nombre']) ?>. Desde aquí puedes gestionar tu perfil y datos familiares.</p>

  <div class="row g-4">

    <!-- Editar perfil -->
    <div class="col-md-6">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Editar Perfil</h5>
          <p class="card-text">Actualiza tu nombre, correo o contraseña.</p>
          <a href="/views/editar_perfil.php" class="btn btn-primary w-40">Editar Perfil</a>
        </div>
      </div>
    </div>

    <!-- Gestionar hijos -->
    <div class="col-md-6">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Gestión de Hijos/as</h5>
          <p class="card-text">Añade, modifica o elimina las fechas de nacimiento de tus hijos.</p>
          <a href="/views/gestionar_hijos.php" class="btn btn-primary w-40">Gestionar Hijos</a>
        </div>
      </div>
    </div>

    <!-- Ver calendario -->
    <div class="col-md-6">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Mi Calendario Vacunal</h5>
          <p class="card-text">Consulta recordatorios automáticos según las fechas de nacimiento registradas.</p>
          <a href="/controllers/calendarioUsuarioController.php" class="btn btn-primary w-40">Ver Calendario</a>
        </div>
      </div>
    </div>

    <!-- Eliminar cuenta -->
    <div class="col-md-6">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Eliminar Cuenta</h5>
          <p class="card-text">Si lo deseas, puedes eliminar tu cuenta y todos los datos asociados.</p>
          <a href="/controllers/eliminarCuentaController.php"
             onclick="return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.');"
             class="btn btn-danger w-40">
             Eliminar Cuenta
          </a>
        </div>
      </div>
    </div>

  </div>
</section>


<?php require_once __DIR__ . '/footer.php'; ?>
