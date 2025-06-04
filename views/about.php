<?php
require_once 'header.php'; // ✅ Encabezado común del sitio
?>

<!-- 🌟 Sección Sobre Nosotros -->
<section id="sobre-nosotros" class="py-5"> <!-- Padding vertical -->
  <div class="container-xl"> <!-- ✅ Ancho extra grande para mejor legibilidad -->
    
    <!-- 🔷 Título principal -->
    <h2 class="text-center section-header mb-4">Sobre vacunacion.info</h2>

    <!-- 📝 Descripción introductoria -->
    <p class="text-center mb-5 mx-auto" style="max-width: 720px;">
      En <strong>vacunacion.info</strong>, somos una organización sin ánimo de lucro compuesta por profesionales sanitarias.
      Nos dedicamos a derribar falsos mitos sobre la vacunación mediante ciencia y evidencia, a recordar las fechas de vacunas y a proporcionar recomendaciones de salud fiables.
    </p>

    <!-- 🔳 Tres columnas: Misión, Actividad, Equipo -->
    <div class="row gy-4"> <!-- Gy = gutter vertical -->

      <!-- 📌 Columna 1: Misión -->
      <div class="col-12 col-md-6 col-lg-4 d-flex">
        <div class="icon-box w-100 text-center p-3 border rounded shadow-sm">
          <i class="fas fa-bullseye fa-2x text-primary"></i>
          <h4 class="mt-3">Nuestra Misión</h4>
          <p>Fortalecer la confianza en la vacunación mediante educación verificada y tranquilizar a las familias.</p>
        </div>
      </div>

      <!-- 📌 Columna 2: Qué hacemos -->
      <div class="col-12 col-md-6 col-lg-4 d-flex">
        <div class="icon-box w-100 text-center p-3 border rounded shadow-sm">
          <i class="fas fa-hands-helping fa-2x text-success"></i>
          <h4 class="mt-3">Lo que Hacemos</h4>
          <p>Recordatorios automáticos, información sanitaria fiable y recomendaciones personalizadas.</p>
        </div>
      </div>

      <!-- 📌 Columna 3: Nuestro equipo -->
      <div class="col-12 col-md-6 col-lg-4 d-flex">
        <div class="icon-box w-100 text-center p-3 border rounded shadow-sm">
          <i class="fas fa-users fa-2x text-warning"></i>
          <h4 class="mt-3">Nuestro Equipo</h4>
          <p>Sanitarias, desarrolladoras y madres unidas por la salud infantil y la tecnología.</p>
        </div>
      </div>

    </div>
  </div>
</section>

<?php
require_once 'footer.php'; // ✅ Pie de página común
?>
