<?php require_once "header.php"; ?>

<!-- Banner que se despliega para descargar la aplicación -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <button id="installAppButton" class="btn btn-primary d-none ms-auto me-2">
      <i class="bi bi-cloud-arrow-down"></i> Instalar App
    </button>
  </div>
</nav>
<!-- 🖼 Carrusel SOLO visible en md+ -->
<div class="d-none d-md-block">
  <div id="carouselFade" class="carousel slide carousel-fade w-100" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="/views/bootstrap/img/slider/foto1.webp" class="d-block w-100" alt="Imagen 1">
      </div>
      <div class="carousel-item">
        <img src="/views/bootstrap/img/slider/foto2.webp" class="d-block w-100" alt="Imagen 2">
      </div>
      <div class="carousel-item">
        <img src="/views/bootstrap/img/slider/foto3.webp" class="d-block w-100" alt="Imagen 3">
      </div>
    </div>

    <!-- Botón anterior -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselFade" data-bs-slide="prev" aria-label="Anterior">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </button>

    <!-- Botón siguiente -->
    <button class="carousel-control-next" type="button" data-bs-target="#carouselFade" data-bs-slide="next" aria-label="Siguiente">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </button>
  </div>
</div>

<!-- 🖼 Imagen fija para móviles -->
<div class="d-block d-md-none">
  <img src="/views/bootstrap/img/slider/foto3.webp" class="img-fluid w-100" alt="Imagen 3">
</div>

<!-- ✅ Sección de Guía de Vacunación -->
<section class="container-fluid my-5 px-4">
  <h2 class="text-center mb-4">Guía de vacunación</h2>
  <div class="row g-4 justify-content-center">

    <!-- Card: Calculadora -->
    <div class="col-12 col-sm-6 col-lg-4">
      <div class="card text-center shadow rounded-4 h-100">
        <div class="card-body">
          <i class="fas fa-syringe fa-2x text-primary mb-3"></i>
          <h2 class="card-title fs-5">Calculadora de medicación</h2>
          <p class="card-text">Calcula dosis seguras según el peso y edad de tu hijo/a.</p>
          <a href="/views/calculadora.php" class="btn btn-primary">Ir a la calculadora</a>
        </div>
      </div>
    </div>

    <!-- Card: Calendarios -->
    <div class="col-12 col-sm-6 col-lg-4">
      <div class="card text-center shadow rounded-4 h-100">
        <div class="card-body">
          <i class="fas fa-calendar-check fa-2x text-success mb-3"></i>
          <h2 class="card-title fs-5">Calendarios vacunales</h2>
          <p class="card-text">Consulta el calendario vacunal infantil oficial por edades.</p>
          <a href="/views/calendariosVacunacion.php" class="btn btn-success text-white">Ver calendarios</a>
        </div>
      </div>
    </div>

    <!-- Card: FAQ -->
    <div class="col-12 col-sm-6 col-lg-4">
      <div class="card text-center shadow rounded-4 h-100">
        <div class="card-body">
          <i class="fas fa-question-circle fa-2x text-warning mb-3"></i>
          <h2 class="card-title fs-5">Preguntas frecuentes</h2>
          <p class="card-text">Resuelve dudas comunes sobre vacunas, efectos y procesos.</p>
          <a href="/views/preguntasFrecuentes.php" class="btn btn-warning text-dark">Ver preguntas</a>
        </div>
      </div>
    </div>

  </div>
</section>

<?php require_once "footer.php"; ?>
