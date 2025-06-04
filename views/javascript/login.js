// Ejecuta el código una vez que el DOM esté completamente cargado
window.addEventListener("DOMContentLoaded", function () {

  // ======= VARIABLES DEL MODAL DE LOGIN Y REGISTRO =======

  const loginOverlay = document.getElementById("loginOverlay"); // Modal de login
  const abrirLoginBtns = document.querySelectorAll("#abrirLogin, #abrirLoginMenu"); // Botones para abrir el login
  const cerrarLogin = document.getElementById("cerrarLogin"); // Botón para cerrar el login
  const abrirRegistroBtn = document.getElementById("abrirRegistro"); // Botón que cambia de login a registro
  const registroOverlay = document.getElementById("registroOverlay"); // Modal de registro

  // ======= FUNCIONES PARA MOSTRAR Y OCULTAR LOGIN =======

  // Muestra el login y oculta el registro
  function mostrarLogin() {
    loginOverlay.style.display = "flex"; // Muestra el login (flex para centrar)
    if (registroOverlay) registroOverlay.style.display = "none"; // Oculta el registro si existe
    document.body.style.overflow = "hidden"; // Evita que se haga scroll al fondo
  }

  // Oculta el login
  function cerrarLoginModal() {
    loginOverlay.style.display = "none";
    document.body.style.overflow = ""; // Reactiva scroll
  }

  // Asocia el evento click a los botones para abrir el login
  abrirLoginBtns.forEach(btn => {
    btn.addEventListener("click", e => {
      e.preventDefault();
      mostrarLogin();
    });
  });

  // Evento para cerrar el login
  if (cerrarLogin) {
    cerrarLogin.addEventListener("click", cerrarLoginModal);
  }

  // Botón para pasar de login a registro
  if (abrirRegistroBtn) {
    abrirRegistroBtn.addEventListener("click", e => {
      e.preventDefault();
      loginOverlay.style.display = "none"; // Oculta login
      registroOverlay.style.display = "flex"; // Muestra registro
    });
  }

  // ======= VALIDACIÓN DEL FORMULARIO DE LOGIN =======

  const loginForm = document.getElementById("form-login"); // Formulario de login
  const loginEmail = document.getElementById("email"); // Campo de email
  const loginPassword = document.getElementById("password"); // Campo de contraseña

  // Valida el email del login
  function validarLoginEmail() {
    const valor = loginEmail.value.trim(); // Elimina espacios
    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // Expresión regular para email

    loginEmail.classList.remove("is-valid", "is-invalid"); // Reinicia clases Bootstrap

    if (!valor || !regex.test(valor)) {
      loginEmail.classList.add("is-invalid"); // Muestra error
      return false;
    }

    loginEmail.classList.add("is-valid"); // Email correcto
    return true;
  }

  // Valida la contraseña del login
  function validarLoginPassword() {
    const valor = loginPassword.value.trim(); // Elimina espacios
    // Reglas de validación
    const longitud = /^.{8,15}$/;
    const mayus = /[A-Z]/;
    const minus = /[a-z]/;
    const digito = /\d/;
    const especial = /[!@#$%^&*(),.?":{}|<>]/;
    const sinEspacios = /^\S+$/;

    loginPassword.classList.remove("is-valid", "is-invalid"); // Reinicia clases

    // Verifica que cumple todas las condiciones
    const esValida = valor && longitud.test(valor) && mayus.test(valor) && minus.test(valor) && digito.test(valor) && especial.test(valor) && sinEspacios.test(valor);

    if (!esValida) {
      loginPassword.classList.add("is-invalid");
      loginPassword.setCustomValidity("Contraseña incorrecta"); // Marca como no válida
      return false;
    } else {
      loginPassword.setCustomValidity(""); // Resetea validación personalizada
      loginPassword.classList.add("is-valid");
      return true;
    }
  }

  // Al enviar el formulario, valida los campos
  if (loginForm) {
    loginForm.addEventListener("submit", e => {
      if (!validarLoginEmail() || !validarLoginPassword()) {
        e.preventDefault(); // Si hay errores, evita que se envíe
      }
    });

    // Validación en tiempo real
    loginEmail.addEventListener("input", validarLoginEmail);
    loginPassword.addEventListener("input", validarLoginPassword);
  }

});
