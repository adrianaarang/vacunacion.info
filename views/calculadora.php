<?php require_once "header.php"; ?> <!-- Encabezado común -->

<body class="bg-light"> <!-- Fondo claro para la sección -->

<!-- Contenedor principal -->
<div class="container py-5">
  <h1 class="text-center mb-4">Calculadora de Dosis Pediátrica</h1>

  <!-- Tarjeta de Bootstrap con sombra y bordes redondeados -->
  <div class="card p-4 shadow rounded-4">
    
    <!-- Formulario de cálculo -->
    <form id="dosisForm">
      
      <!-- Selección de medicamento -->
      <div class="mb-3">
        <label for="medicamento" class="form-label">Medicamento</label>
        <select class="form-select" id="medicamento" required onchange="toggleIbuprofenoOpciones()">
          <option value="" selected disabled>Seleccione...</option>
          <option value="ibuprofeno">Ibuprofeno</option>
          <option value="paracetamol">Paracetamol</option>
        </select>
      </div>

      <!-- Opciones extra para ibuprofeno -->
      <div id="ibuprofenoOpciones" class="mb-3 d-none">
        <label class="form-label">Presentación de Ibuprofeno</label>
        <select class="form-select" id="concentracionIbuprofeno">
          <option value="20">20 mg/ml</option>
          <option value="40">40 mg/ml</option>
        </select>
      </div>

      <!-- Campo de entrada del peso del niño -->
      <div class="mb-3">
        <label for="peso" class="form-label">Peso del niño (kg)</label>
        <input type="number" class="form-control" id="peso" placeholder="Ej: 12.5" step="0.1" min="1" required>
      </div>

      <!-- Botón de enviar -->
      <button type="submit" class="btn btn-primary w-100">Calcular dosis</button>
    </form>

    <!-- Resultado oculto que se mostrará tras el cálculo -->
    <div id="resultado" class="alert alert-info mt-4 d-none"></div>
  </div>
</div>

<!-- Pie de página común -->
<?php require_once "footer.php"; ?> 
