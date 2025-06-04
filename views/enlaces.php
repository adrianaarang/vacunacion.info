<?php 
// Incluye el encabezado general del sitio con navegación
require_once __DIR__ . '/header.php'; 
?>

<!-- Sección principal con título y descripción -->
<section class="container-xl my-5">
  <h1 class="text-center mb-4">Enlaces de Interés: Beneficios de la Vacunación Infantil</h1>

  <p class="lead text-center mb-5">
    Descubre información respaldada por evidencia científica sobre la importancia de vacunar a los más pequeños.
  </p>

  <!-- Contenedor responsive de tarjetas con enlaces -->
  <div class="row row-cols-1 row-cols-md-2 g-4">

    <!-- Tarjeta 1: Ministerio de Sanidad -->
    <div class="col">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Ministerio de Sanidad de España</h5>
          <p class="card-text">Información oficial sobre los beneficios de la vacunación y su papel en la prevención de enfermedades.</p>
          <a href="https://www.sanidad.gob.es/campannas/campanas16/vacunacionBeneficios.htm" target="_blank" class="btn btn-primary">Visitar sitio</a>
        </div>
      </div>
    </div>

    <!-- Tarjeta 2: Asociación Española de Pediatría -->
    <div class="col">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Asociación Española de Pediatría</h5>
          <p class="card-text">Recomendaciones actualizadas sobre vacunación infantil y juvenil basadas en las últimas evidencias científicas.</p>
          <a href="https://www.actapediatrica.com/index.php/sumario-marzo-abril-2020/1438-la-asociacion-espanola-de-pediatria-actualiza-sus-recomendaciones-de-vacunacion-infantil-y-juvenil-segun-las-ultimas-evidencias-cientificas" target="_blank" class="btn btn-primary">Visitar sitio</a>
        </div>
      </div>
    </div>

    <!-- Tarjeta 3: UNICEF -->
    <div class="col">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">UNICEF</h5>
          <p class="card-text">Información sobre cómo las vacunas protegen a los niños contra enfermedades graves y salvan millones de vidas.</p>
          <a href="https://www.unicef.org/parenting/es/salud/lo-que-debes-saber-sobre-vacunas-infantiles" target="_blank" class="btn btn-primary">Visitar sitio</a>
        </div>
      </div>
    </div>

    <!-- Tarjeta 4: ECDC -->
    <div class="col">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Centro Europeo para la Prevención y el Control de Enfermedades (ECDC)</h5>
          <p class="card-text">Beneficios de la vacunación y su impacto en la salud pública en Europa.</p>
          <a href="https://vaccination-info.europa.eu/es/acerca-de-las-vacunas/los-beneficios-de-la-vacunacion" target="_blank" class="btn btn-primary">Visitar sitio</a>
        </div>
      </div>
    </div>

    <!-- Tarjeta 5: CDC -->
    <div class="col">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Centros para el Control y la Prevención de Enfermedades (CDC)</h5>
          <p class="card-text">Importancia de vacunar a los niños para prevenir enfermedades graves y proteger a la comunidad.</p>
          <a href="https://www.cdc.gov/vaccines/parents/why-vaccinate/index-sp.html" target="_blank" class="btn btn-primary">Visitar sitio</a>
        </div>
      </div>
    </div>

    <!-- Tarjeta 6: Cochrane Review -->
    <div class="col">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Cochrane Review: Efectividad de las vacunas en la infancia</h5>
          <p class="card-text">Revisión sistemática de Cochrane que evalúa la eficacia de la vacunación infantil en la prevención de enfermedades graves y mortalidad.</p>
          <a href="https://www.cochranelibrary.com/cdsr/doi/10.1002/14651858.CD004407.pub4/full" target="_blank" class="btn btn-primary">Leer estudio</a>
        </div>
      </div>
    </div>

  </div> <!-- Fin del row de tarjetas -->
</section>

<?php 
// Incluye el pie de página del sitio
require_once __DIR__ . '/footer.php'; 
?>
