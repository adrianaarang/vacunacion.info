<?php
require_once "header.php"; 
?>

<body class="bg-light">

<div class="container py-5">
  <h1 class="text-center mb-4">Calculadora de Dosis Pediátrica</h1>

  <div class="card p-4 shadow rounded-4">
    <form id="dosisForm">
      <div class="mb-3">
        <label for="medicamento" class="form-label">Medicamento</label>
        <select class="form-select" id="medicamento" required onchange="toggleIbuprofenoOpciones()">
          <option value="" selected disabled>Seleccione...</option>
          <option value="ibuprofeno">Ibuprofeno</option>
          <option value="paracetamol">Paracetamol</option>
        </select>
      </div>

      <div id="ibuprofenoOpciones" class="mb-3 d-none">
        <label class="form-label">Presentación de Ibuprofeno</label>
        <select class="form-select" id="concentracionIbuprofeno">
          <option value="20">20 mg/ml</option>
          <option value="40">40 mg/ml</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="peso" class="form-label">Peso del niño (kg)</label>
        <input type="number" class="form-control" id="peso" placeholder="Ej: 12.5" step="0.1" min="1" required>
      </div>

      <button type="submit" class="btn btn-primary w-100">Calcular dosis</button>
    </form>

    <div id="resultado" class="alert alert-info mt-4 d-none"></div>
  </div>
</div>


<?php
require_once"footer.php";
?>