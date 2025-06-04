<?php
// Incluyo el encabezado común de la web (con navegación y recursos compartidos)
require_once 'header.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <!-- Configuración básica de HTML -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Preguntas Frecuentes sobre Vacunación</title>

  <!-- Hoja de estilos de Bootstrap y bibliotecas de iconos -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Estilos personalizados para el comportamiento visual del acordeón -->
  <style>
    .accordion-button:not(.collapsed) {
      background-color: #f0f0f0;
      color: #000;
    }
    .accordion-button.collapsed {
      background-color: #ffffff;
      color: #000;
    }
    .accordion-body {
      font-size: 1rem;
    }
  </style>
</head>
<body class="bg-light">

<!-- Contenedor principal del contenido -->
<div class="container py-5">
  <h1 class="text-center mb-4 titulo-principal">Preguntas Frecuentes sobre Vacunación</h1>

  <!-- Acordeón de preguntas frecuentes -->
  <div class="accordion" id="faqAccordion">

    <!-- Pregunta 1: Seguridad de las vacunas -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
          ¿Las vacunas son seguras?
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Sí. Las vacunas pasan por múltiples fases de pruebas clínicas rigurosas antes de ser aprobadas. Una vez en uso, siguen siendo monitoreadas para garantizar su seguridad.
        </div>
      </div>
    </div>

    <!-- Pregunta 2: Relación con el autismo -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
          ¿Las vacunas pueden causar autismo?
        </button>
      </h2>
      <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          No. Numerosos estudios científicos han demostrado que no existe relación entre las vacunas y el autismo. Esta idea se originó en un estudio fraudulento que ya fue completamente desacreditado.
        </div>
      </div>
    </div>

    <!-- Pregunta 3: Vacunación ante enfermedades erradicadas -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
          ¿Por qué vacunar si algunas enfermedades ya no existen?
        </button>
      </h2>
      <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Las enfermedades pueden reaparecer si dejamos de vacunarnos. La inmunidad colectiva protege incluso a quienes no pueden vacunarse, como bebés o personas inmunodeprimidas.
        </div>
      </div>
    </div>

    <!-- Pregunta 4: Vacunarse con resfriado -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingFour">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
          ¿Puedo vacunarme si estoy resfriado?
        </button>
      </h2>
      <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Sí, si los síntomas son leves (como congestión nasal o tos leve), la vacunación no suele estar contraindicada. En caso de fiebre alta, es mejor posponerla.
        </div>
      </div>
    </div>

    <!-- Pregunta 5: Efectos secundarios -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingFive">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive">
          ¿Qué efectos secundarios pueden tener las vacunas?
        </button>
      </h2>
      <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Los efectos secundarios suelen ser leves: enrojecimiento, hinchazón o dolor en el sitio de la inyección, fiebre baja o malestar general. Reacciones graves son muy poco frecuentes.
        </div>
      </div>
    </div>

    <!-- Pregunta 6: Importancia de la vacunación infantil -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingSix">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix">
          ¿Por qué es tan importante vacunar a los niños desde pequeños?
        </button>
      </h2>
      <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Los niños pequeños son más vulnerables a enfermedades infecciosas graves. Vacunarlos a tiempo les permite desarrollar inmunidad antes de estar expuestos a virus y bacterias peligrosas. Además, protege a otros niños que aún no pueden vacunarse.
        </div>
      </div>
    </div>

    <!-- Pregunta 7: Vacunas para viajeros -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingSeven">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven">
          ¿Qué vacunas necesito si voy a viajar?
        </button>
      </h2>
      <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Depende del destino. Algunas regiones exigen vacunas específicas como la fiebre amarilla, tifoidea o hepatitis A.
          También se recomiendan refuerzos de vacunas comunes. Consulta con un centro de vacunación internacional al menos 4-6 semanas antes de viajar.
        </div>
      </div>
    </div>

  </div> <!-- Cierre del acordeón -->
</div> <!-- Cierre del contenedor principal -->

<!-- Scripts necesarios para Bootstrap y funcionalidades de login/registro -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/views/javascript/login.js"></script>
<script src="/views/javascript/registro.js"></script>

</body>
</html>

<?php
// Incluyo el pie de página común
require_once "footer.php";
?>
