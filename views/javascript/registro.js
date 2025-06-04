window.addEventListener("DOMContentLoaded", function () {
  // === ELEMENTOS DEL DOM ===
  const form = document.getElementById("form-register");
  const registroOverlay = document.getElementById("registroOverlay");
  const cerrarRegistro = document.getElementById("cerrarRegistro");
  const mostrarLoginDesdeRegistro = document.getElementById("mostrarLoginDesdeRegistro");
  const abrirDesdeRegistro = document.getElementById("abrirDesdeRegistro");
  const loginOverlay = document.getElementById("loginOverlay");

  const nombre = document.getElementById("nombre");
  const email = document.getElementById("emailRegistro");
  const password = document.getElementById("passwordRegistro");
  const numHijosInput = document.getElementById("num_hijos");
  const childrenDatesContainer = document.getElementById("children-dates");

  const errorNombre = document.getElementById("errorNombre");
  const errorEmail = document.getElementById("errorEmailRegistro");
  const errorPassword = document.getElementById("errorPasswordRegistro");

  // === CAMBIO ENTRE LOGIN Y REGISTRO ===
  function mostrarLogin() {
    registroOverlay.style.display = "none";
    loginOverlay.style.display = "flex";
  }

  cerrarRegistro?.addEventListener("click", () => registroOverlay.style.display = "none");
  mostrarLoginDesdeRegistro?.addEventListener("click", e => { e.preventDefault(); mostrarLogin(); });
  abrirDesdeRegistro?.addEventListener("click", e => { e.preventDefault(); mostrarLogin(); });

  // === CAMPOS FECHAS DINÁMICOS ===
  function generateChildrenInputs() {
    const num = parseInt(numHijosInput.value);
    childrenDatesContainer.innerHTML = "";

    if (!isNaN(num) && num > 0) {
      for (let i = 1; i <= num; i++) {
        const div = document.createElement("div");
        div.classList.add("mb-3");

        div.innerHTML = `
          <label for="fecha_nacimiento_${i}" class="form-label">Fecha de Nacimiento del Hijo ${i}</label>
          <input type="date" class="form-control" name="fecha_nacimiento_${i}" id="fecha_nacimiento_${i}" required>
          <div id="error_fecha_${i}" class="invalid-feedback"></div>
        `;

        childrenDatesContainer.appendChild(div);
      }
    }
  }

  if (numHijosInput) {
    numHijosInput.addEventListener("input", generateChildrenInputs);
    if (numHijosInput.value) generateChildrenInputs(); // Para editar
  }

  // === VALIDACIONES ===
  function validarNombre() {
    const valor = nombre.value.trim();
    const regex = /^[A-ZÁÉÍÓÚÜÑa-záéíóúüñ-]+(?: [A-ZÁÉÍÓÚÜÑa-záéíóúüñ-]+)?$/;

    if (!valor) {
      errorNombre.textContent = "El nombre es obligatorio.";
    } else if (valor.length > 50) {
      errorNombre.textContent = "Máximo 50 caracteres.";
    } else if (!regex.test(valor)) {
      errorNombre.textContent = "Introduce solo uno o dos nombres.";
    } else {
      nombre.classList.remove("is-invalid");
      nombre.classList.add("is-valid");
      errorNombre.textContent = "";
      return true;
    }

    nombre.classList.add("is-invalid");
    return false;
  }

  function validarEmail() {
    const valor = email.value.trim();
    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (!valor) {
      errorEmail.textContent = "El email es obligatorio.";
    } else if (!regex.test(valor)) {
      errorEmail.textContent = "Email no válido.";
    } else {
      email.classList.remove("is-invalid");
      email.classList.add("is-valid");
      errorEmail.textContent = "";
      return true;
    }

    email.classList.add("is-invalid");
    return false;
  }

  function validarPassword() {
    const valor = password.value.trim();
    const requisitos = [
      /^.{8,15}$/,      // longitud
      /[A-Z]/,          // mayúscula
      /[a-z]/,          // minúscula
      /\d/,             // número
      /[!@#$%^&*(),.?":{}|<>]/, // símbolo
      /^\S+$/           // sin espacios
    ];

    if (!valor) {
      errorPassword.textContent = "La contraseña es obligatoria.";
    } else if (!requisitos.every(r => r.test(valor))) {
      errorPassword.textContent = "Debe tener entre 8 y 15 caracteres, incluir mayúsculas, minúsculas, un número y un símbolo.";
    } else {
      password.classList.remove("is-invalid");
      password.classList.add("is-valid");
      errorPassword.textContent = "";
      return true;
    }

    password.classList.add("is-invalid");
    return false;
  }

  function validarNumeroHijos() {
    const valor = parseInt(numHijosInput.value, 10);
    if (isNaN(valor) || valor < 1) {
      numHijosInput.classList.add("is-invalid");
      return false;
    }
    numHijosInput.classList.remove("is-invalid");
    numHijosInput.classList.add("is-valid");
    return true;
  }

  function validarFechasHijos() {
    const hoy = new Date();
    let valido = true;

    const inputsFecha = childrenDatesContainer.querySelectorAll("input[type='date']");
    inputsFecha.forEach((input, i) => {
      const errorDiv = document.getElementById(`error_fecha_${i + 1}`);
      const fecha = new Date(input.value);

      input.classList.remove("is-valid", "is-invalid");
      errorDiv.textContent = "";

      if (!input.value) {
        errorDiv.textContent = "La fecha es obligatoria.";
        input.classList.add("is-invalid");
        valido = false;
      } else if (fecha > hoy || fecha.getFullYear() < hoy.getFullYear() - 18) {
        errorDiv.textContent = "Debe tener entre 0 y 18 años.";
        input.classList.add("is-invalid");
        valido = false;
      } else {
        input.classList.add("is-valid");
      }
    });

    return valido;
  }

  // === VALIDACIÓN FINAL ===
  form.addEventListener("submit", e => {
    if (
      !validarNombre() ||
      !validarEmail() ||
      !validarPassword() ||
      !validarNumeroHijos() ||
      !validarFechasHijos()
    ) {
      e.preventDefault();
    }
  });

  // === VALIDACIÓN EN TIEMPO REAL ===
  nombre.addEventListener("input", validarNombre);
  email.addEventListener("input", validarEmail);
  password.addEventListener("input", validarPassword);
});

// === CARGA DE COMUNIDADES POR AJAX ===
const comunidadSelect = document.getElementById('comunidad_id');

if (comunidadSelect) {
  fetch('/TFG/controllers/getComunidades.php')
    .then(res => res.json())
    .then(data => {
      if (!Array.isArray(data)) throw new Error("Respuesta inesperada");
      data.forEach(comunidad => {
        const option = document.createElement('option');
        option.value = comunidad.id;
        option.textContent = comunidad.nombre;
        comunidadSelect.appendChild(option);
      });
    })
    .catch(error => {
      console.error('Error al cargar comunidades:', error);
      const option = document.createElement('option');
      option.disabled = true;
      option.textContent = 'Error al cargar comunidades';
      comunidadSelect.appendChild(option);
    });
}
