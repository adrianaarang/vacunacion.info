window.addEventListener("DOMContentLoaded", function () {
  // ====== ELEMENTOS DEL DOM ======
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

  const comunidadSelect = document.getElementById('comunidad_id');

  // ====== CAMBIO ENTRE LOGIN Y REGISTRO ======
  function mostrarLogin() {
    registroOverlay.style.display = "none";
    loginOverlay.style.display = "flex";
  }

  if (cerrarRegistro) {
    cerrarRegistro.addEventListener("click", () => registroOverlay.style.display = "none");
  }

  if (mostrarLoginDesdeRegistro) {
    mostrarLoginDesdeRegistro.addEventListener("click", e => {
      e.preventDefault();
      mostrarLogin();
    });
  }

  if (abrirDesdeRegistro) {
    abrirDesdeRegistro.addEventListener("click", e => {
      e.preventDefault();
      mostrarLogin();
    });
  }

  // ====== GENERACIÓN DINÁMICA DE CAMPOS DE FECHAS DE HIJOS ======
  function generateChildrenInputs() {
    const num = parseInt(numHijosInput.value);
    childrenDatesContainer.innerHTML = "";

    if (!isNaN(num) && num > 0) {
      for (let i = 1; i <= num; i++) {
        const div = document.createElement("div");
        div.classList.add("mb-3");

        const label = document.createElement("label");
        label.classList.add("form-label");
        label.setAttribute("for", `fecha_nacimiento_${i}`);
        label.textContent = `Fecha de Nacimiento del Hijo ${i}`;

        const input = document.createElement("input");
        input.classList.add("form-control");
        input.type = "date";
        input.name = `fecha_nacimiento_${i}`;
        input.id = `fecha_nacimiento_${i}`;
        input.required = true;

        const error = document.createElement("div");
        error.id = `error_fecha_${i}`;
        error.classList.add("invalid-feedback");

        // ✅ Validación en tiempo real
        input.addEventListener("input", validarFechasHijos);

        div.appendChild(label);
        div.appendChild(input);
        div.appendChild(error);
        childrenDatesContainer.appendChild(div);
      }
    }
  }

  if (numHijosInput) {
    numHijosInput.addEventListener("input", generateChildrenInputs);
    if (numHijosInput.value) generateChildrenInputs(); // Para modo edición
  }

  // ====== VALIDACIONES ======
  function validarNombre() {
    const valor = nombre.value.trim();
    const regex = /^[A-ZÁÉÍÓÚÜÑa-záéíóúüñ-]+(?: [A-ZÁÉÍÓÚÜÑa-záéíóúüñ-]+)?$/;

    if (!valor) {
      errorNombre.textContent = "El nombre es obligatorio.";
      nombre.classList.add("is-invalid");
      return false;
    } else if (valor.length > 50) {
      errorNombre.textContent = "Máximo 50 caracteres.";
      nombre.classList.add("is-invalid");
      return false;
    } else if (!regex.test(valor)) {
      errorNombre.textContent = "Introduce solo uno o dos nombres.";
      nombre.classList.add("is-invalid");
      return false;
    }

    errorNombre.textContent = "";
    nombre.classList.remove("is-invalid");
    nombre.classList.add("is-valid");
    return true;
  }

  function validarEmail() {
    const valor = email.value.trim();
    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    email.classList.remove("is-valid", "is-invalid");

    if (!valor) {
      errorEmail.textContent = "El email es obligatorio.";
      email.classList.add("is-invalid");
      return false;
    } else if (!regex.test(valor)) {
      errorEmail.textContent = "Email no válido.";
      email.classList.add("is-invalid");
      return false;
    }

    errorEmail.textContent = "";
    email.classList.add("is-valid");
    return true;
  }

  function validarPassword() {
    const valor = password.value.trim();
    const longitud = /^.{8,15}$/;
    const mayus = /[A-Z]/;
    const minus = /[a-z]/;
    const digito = /\d/;
    const especial = /[!@#$%^&*(),.?":{}|<>]/;
    const sinEspacios = /^\S+$/;

    password.classList.remove("is-invalid", "is-valid");

    if (!valor) {
      errorPassword.textContent = "La contraseña es obligatoria.";
      password.classList.add("is-invalid");
      return false;
    }

    const esValida = longitud.test(valor) && mayus.test(valor) && minus.test(valor) && digito.test(valor) && especial.test(valor) && sinEspacios.test(valor);

    if (!esValida) {
      errorPassword.textContent = "Debe tener entre 8 y 15 caracteres, incluir mayúsculas, minúsculas, un número y un símbolo.";
      password.classList.add("is-invalid");
      return false;
    }

    errorPassword.textContent = "";
    password.classList.add("is-valid");
    return true;
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
      const valor = input.value;

      input.classList.remove("is-valid", "is-invalid");
      errorDiv.textContent = "";

      if (!valor) {
        errorDiv.textContent = "La fecha es obligatoria.";
        input.classList.add("is-invalid");
        valido = false;
        return;
      }

      const fecha = new Date(valor + "T00:00:00");

      if (isNaN(fecha.getTime())) {
        errorDiv.textContent = "Fecha no válida.";
        input.classList.add("is-invalid");
        valido = false;
        return;
      }

      if (fecha > hoy) {
        errorDiv.textContent = "La fecha no puede ser futura.";
        input.classList.add("is-invalid");
        valido = false;
        return;
      }

      const edadMs = hoy.getTime() - fecha.getTime();
      const edadDate = new Date(edadMs);
      const edad = Math.abs(edadDate.getUTCFullYear() - 1970);

      if (edad < 0 || edad > 18) {
        errorDiv.textContent = "Debe tener entre 0 y 18 años.";
        input.classList.add("is-invalid");
        valido = false;
      } else {
        input.classList.add("is-valid");
      }
    });

    return valido;
  }

  // ====== VALIDACIÓN FINAL EN EL ENVÍO DEL FORMULARIO ======
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

  // ====== VALIDACIÓN EN TIEMPO REAL ======
  nombre.addEventListener("input", validarNombre);
  email.addEventListener("input", validarEmail);
  password.addEventListener("input", validarPassword);

  // ====== CARGAR COMUNIDADES CON AJAX ======
  if (comunidadSelect) {
    fetch('/controllers/getComunidades.php')
      .then(res => {
        if (!res.ok) throw new Error("Respuesta no válida del servidor");
        return res.json();
      })
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
});
