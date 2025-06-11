// Esperar a que todo el DOM esté cargado antes de ejecutar
document.addEventListener("DOMContentLoaded", function () {
  // Verificar que el formulario de dosis exista en esta página
  const dosisForm = document.getElementById("dosisForm");
  const resultadoDiv = document.getElementById("resultado");

  // Mostrar/ocultar opciones de concentración solo si se elige ibuprofeno
  const medicamentoSelect = document.getElementById("medicamento");
  const ibuprofenoOpciones = document.getElementById("ibuprofenoOpciones");

  if (medicamentoSelect && ibuprofenoOpciones) {
    medicamentoSelect.addEventListener("change", function () {
      ibuprofenoOpciones.classList.toggle("d-none", this.value !== "ibuprofeno");
    });
  }

  // Evento de envío del formulario
  if (dosisForm && resultadoDiv) {
    dosisForm.addEventListener("submit", function (e) {
      e.preventDefault();

      const medicamento = document.getElementById("medicamento").value;
      const peso = parseFloat(document.getElementById("peso").value);
      let resultadoTexto = "";

      // Cálculo para Ibuprofeno
      if (medicamento === "ibuprofeno") {
        const concentracion = parseFloat(document.getElementById("concentracionIbuprofeno").value);

        let volumenMl = 0;

        // Fórmula práctica:
        // 20 mg/ml → peso / 3
        // 40 mg/ml → peso / 3 / 2
        if (concentracion === 20) {
          volumenMl = peso / 3;
        } else if (concentracion === 40) {
          volumenMl = peso / 3 / 2;
        }

        resultadoTexto = `
          <strong>Ibuprofeno (${concentracion} mg/ml):</strong><br>
          Volumen a administrar: <strong>${volumenMl.toFixed(1)} ml</strong><br>
          Frecuencia habitual: cada 8 horas
        `;
      }

      // Cálculo para Paracetamol
      else if (medicamento === "paracetamol") {
        const dosisMg = peso * 15; // Dosis recomendada
        const concentracion = 100; // mg/ml estándar
        const volumenMl = dosisMg / concentracion;

        resultadoTexto = `
          <strong>Paracetamol (100 mg/ml):</strong><br>
          Dosis recomendada: <strong>${dosisMg.toFixed(1)} mg</strong><br>
          Volumen a administrar: <strong>${volumenMl.toFixed(1)} ml</strong><br>
          Frecuencia habitual: cada 8  horas
        `;
      }

      // Mostrar el resultado
      resultadoDiv.innerHTML = resultadoTexto;
      resultadoDiv.classList.remove("d-none");
    });
  }
});
