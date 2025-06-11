<?php
require_once __DIR__ . '/header.php';
?>

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
<body class="bg-light">

<div class="container py-5">
  <h1 class="text-center mb-4 titulo-principal">Preguntas Frecuentes sobre Vacunación</h1>

  <div class="accordion" id="faqAccordion">

    <!-- Aquí empiezan las preguntas -->

    <!-- P1 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
          ¿Las vacunas son seguras?
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Sí. Las vacunas pasan por múltiples fases de pruebas clínicas rigurosas antes de ser aprobadas...
        </div>
      </div>
    </div>

    <!-- P2 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
          ¿Las vacunas pueden causar autismo?
        </button>
      </h2>
      <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          No. Numerosos estudios científicos han demostrado...
        </div>
      </div>
    </div>

    <!-- P3 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
          ¿Por qué vacunar si algunas enfermedades ya no existen?
        </button>
      </h2>
      <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Las enfermedades pueden reaparecer si dejamos de vacunarnos...
        </div>
      </div>
    </div>

    <!-- P4 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingFour">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
          ¿Puedo vacunarme si estoy resfriado?
        </button>
      </h2>
      <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Sí, si los síntomas son leves...
        </div>
      </div>
    </div>

    <!-- P5 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingFive">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive">
          ¿Qué efectos secundarios pueden tener las vacunas?
        </button>
      </h2>
      <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Los efectos secundarios suelen ser leves...
        </div>
      </div>
    </div>

    <!-- P6 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingSix">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix">
          ¿Por qué es tan importante vacunar a los niños desde pequeños?
        </button>
      </h2>
      <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Los niños pequeños son más vulnerables...
        </div>
      </div>
    </div>

    <!-- P7 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingSeven">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven">
          ¿Qué vacunas necesito si voy a viajar?
        </button>
      </h2>
      <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Depende del destino. Algunas regiones exigen vacunas específicas...
        </div>
      </div>
    </div>

  </div>
</div>


<?php require_once __DIR__ . '/footer.php'; ?>
