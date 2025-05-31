<?php require_once "header.php"; ?>
<?php include "modalLogin.php"; ?>

<!-- 🖼 Carrusel SOLO visible en md+ -->
<div class="d-none d-md-block">
  <div id="carouselFade" class="carousel slide carousel-fade w-100" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="/TFG/views/bootstrap/img/slider/foto1.png" class="d-block w-100" alt="Imagen 1">
      </div>
      <div class="carousel-item">
        <img src="/TFG/views/bootstrap/img/slider/foto2.png" class="d-block w-100" alt="Imagen 2">
      </div>
      <div class="carousel-item">
        <img src="/TFG/views/bootstrap/img/slider/foto3.png" class="d-block w-100" alt="Imagen 3">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselFade" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselFade" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
</div>

<!-- 🖼 Imagen fija para móviles -->
<div class="d-block d-md-none">
  <img src="/TFG/views/bootstrap/img/slider/foto3.png" class="img-fluid w-100" alt="Imagen 3">
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
          <h5 class="card-title">Calculadora de medicación</h5>
          <p class="card-text">Calcula dosis seguras según el peso y edad de tu hijo/a.</p>
          <a href="/TFG/views/calculadora.php" class="btn btn-outline-primary">Ir a la calculadora</a>
        </div>
      </div>
    </div>

    <!-- Card: Calendarios -->
    <div class="col-12 col-sm-6 col-lg-4">
      <div class="card text-center shadow rounded-4 h-100">
        <div class="card-body">
          <i class="fas fa-calendar-check fa-2x text-success mb-3"></i>
          <h5 class="card-title">Calendarios vacunales</h5>
          <p class="card-text">Consulta el calendario vacunal infantil oficial por edades.</p>
          <a href="/TFG/views/calendariosVacunacion.php" class="btn btn-outline-success">Ver calendarios</a>
        </div>
      </div>
    </div>

    <!-- Card: FAQ -->
    <div class="col-12 col-sm-6 col-lg-4">
      <div class="card text-center shadow rounded-4 h-100">
        <div class="card-body">
          <i class="fas fa-question-circle fa-2x text-warning mb-3"></i>
          <h5 class="card-title">Preguntas frecuentes</h5>
          <p class="card-text">Resuelve dudas comunes sobre vacunas, efectos y procesos.</p>
          <a href="/TFG/views/preguntasFrecuentes.php" class="btn btn-outline-warning">Ver preguntas</a>
        </div>
      </div>
    </div>

  </div>
</section>

<?php require_once "footer.php"; ?>


