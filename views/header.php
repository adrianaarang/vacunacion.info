<?php

if (session_status() === PHP_SESSION_NONE) {

  session_start();

}
?>

<!DOCTYPE html>

<html lang="es">

<head>

  <meta charset="UTF-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1">


  <!-- ? SEO -->

  <title>Vacunacion.info – Calendario, cálculo de dosis y dudas frecuentes</title>

  <meta name="description" content="Vacunacion.info es tu guía completa sobre vacunación infantil. Consulta calendarios por edad, calcula dosis seguras y resuelve dudas frecuentes.">

  <meta name="keywords" content="vacunación, vacunas, calendario vacunal, niños, salud infantil, efectos secundarios, calendario por comunidades">

  <meta name="author" content="Vacunacion.info">

  <link rel="canonical" href="https://vacunacion.info/">


  <!--  Accesibilidad y compatibilidad -->

  <meta name="theme-color" content="#0d6efd">

  <meta name="color-scheme" content="light">

  <meta name="mobile-web-app-capable" content="yes">

  <meta name="apple-mobile-web-app-capable" content="yes">


  <!-- ? Favicon e iconos -->

  <link rel="icon" href="/views/bootstrap/img/logo/logo5.png" type="image/png">

  <link rel="apple-touch-icon" href="/views/bootstrap/img/logo/logo5.png">

<link rel="manifest" href="/manifest.json" crossorigin="use-credentials">



  <!-- ? CSS -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <link rel="stylesheet" href="/views/style.css">

</head>

<body>

<header class="container-fluid text-white">

  <div class="row align-items-center px-3 py-2" style="background-color: var(--header-dark);">

    <div class="col-3">

      <a href="/index.php" class="navbar-brand">

        <img src="/views/bootstrap/img/logo/logo6.webp" alt="Logo" class="img-fluid">

      </a>

    </div>


    <div class="col-12 d-none d-md-flex col-lg-6 justify-content-center">

      <form class="input-group position-relative" id="formBuscador" action="/views/efectosSecundarios.php" method="GET" autocomplete="off">

        <input type="text" class="form-control" id="busquedaVacuna" name="vacuna" placeholder="Buscador de vacunas">

        <button type="submit" class="btn btn-primary" aria-label="Buscar vacuna">

          <i class="fas fa-search" aria-hidden="true"></i>

        </button>

        <ul id="sugerencias" class="border rounded d-none" style="position: absolute; top: 100%; left: 0; width: 100%; background: white; z-index: 1000;"></ul>

      </form>

    </div>


    <div class="col-2 text-end">

      <?php if (isset($_SESSION['email'])): ?>

        <span class="text-white me-2"><i class="fas fa-user"></i> <?= htmlspecialchars($_SESSION['nombre']) ?></span>

      <?php else: ?>

        <a href="#" id="abrirLogin" class="btn text-white"><i class="fas fa-user"></i> Iniciar Sesión</a>

      <?php endif; ?>

    </div>

  </div>


  <nav class="navbar navbar-expand-md navbar-light" style="background-color: var(--header-light);">

    <div class="container-fluid">

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">

        <span class="navbar-toggler-icon"></span>

      </button>

      <div class="collapse navbar-collapse" id="navbarMenu">

        <ul class="navbar-nav me-auto mb-2 mb-md-0">

          <li class="nav-item"><a class="nav-link" href="/index.php">Inicio</a></li>


          <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">Recursos</a>

            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

              <li><a class="dropdown-item" href="/views/calculadora.php">Calculadora de dosis</a></li>

              <li><a class="dropdown-item" href="/views/calendariosVacunacion.php">Calendarios de vacunación</a></li>

              <li><a class="dropdown-item" href="/views/preguntasFrecuentes.php">Preguntas frecuentes</a></li>

              <li><a class="dropdown-item" href="/views/enlaces.php">Enlaces de interés</a></li>

            </ul>

          </li>


          <li class="nav-item"><a class="nav-link" href="/views/efectosSecundarios.php">Vacunas y efectos</a></li>

          <li class="nav-item"><a class="nav-link" href="/views/about.php">Sobre nosotros</a></li>


          <?php if (isset($_SESSION['email'])): ?>

            <?php if ($_SESSION['rol'] !== 'admin'): ?>

              <li class="nav-item"><a class="nav-link" href="/controllers/calendarioUsuarioController.php">Mi Calendario</a></li>

            <?php endif; ?>

            <?php if ($_SESSION['rol'] === 'admin'): ?>

              <li class="nav-item"><a class="nav-link" href="/views/panel_admin.php">Panel Administrador</a></li>

            <?php else: ?>

              <li class="nav-item"><a class="nav-link" href="/views/panel_usuario.php">Mi Perfil</a></li>

            <?php endif; ?>

            <li class="nav-item"><a class="nav-link text-danger" href="/controllers/logout.php">Cerrar sesión</a></li>

          <?php else: ?>

            <li class="nav-item"><a class="nav-link" href="#" id="abrirLoginMenu">Cuenta</a></li>

          <?php endif; ?>

        </ul>

      </div>

    </div>

  </nav>

</header>


<?php if (isset($_SESSION['error_login'])): ?>

  <script>

    window.errorLoginMensaje = <?= json_encode($_SESSION['error_login']) ?>;

  </script>

  <?php unset($_SESSION['error_login']); ?>

<?php else: ?>

  <script>

    window.errorLoginMensaje = null;

  </script>

<?php endif; ?>


<!-- ? SCRIPTS -->

<script src="/views/javascript/buscadorHeader.js"></script>

<script src="/views/javascript/slider.js"></script>

<script src="/views/javascript/calculadora.js"></script>
<script src="/views/javascript/login.js"></script>

<script src="/views/javascript/errorLogin.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php
require_once 'modalLogin.php'; // Solo aquí

?>

