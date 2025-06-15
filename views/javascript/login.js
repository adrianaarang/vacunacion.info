window.addEventListener("DOMContentLoaded", function () {

  // Mostrar el modal de login y ocultar el de registro

  const loginOverlay = document.getElementById("loginOverlay");

  const abrirLoginBtns = document.querySelectorAll("#abrirLogin, #abrirLoginMenu");

  const cerrarLogin = document.getElementById("cerrarLogin");

  const abrirRegistroBtn = document.getElementById("abrirRegistro");

  const registroOverlay = document.getElementById("registroOverlay");


  function mostrarLogin() {

    loginOverlay.style.display = "flex";

    if (registroOverlay) registroOverlay.style.display = "none";

    document.body.style.overflow = "hidden";

  }


  function cerrarLoginModal() {

    loginOverlay.style.display = "none";

    document.body.style.overflow = "";

  }


  abrirLoginBtns.forEach(btn => {

    btn.addEventListener("click", e => {

      e.preventDefault();

      mostrarLogin();

    });

  });


  if (cerrarLogin) {

    cerrarLogin.addEventListener("click", cerrarLoginModal);

  }


  if (abrirRegistroBtn) {

    abrirRegistroBtn.addEventListener("click", e => {

      e.preventDefault();

      loginOverlay.style.display = "none";

      registroOverlay.style.display = "flex";

    });

  }


  // Validación del formulario de login

  const loginForm = document.getElementById("form-login");

  const loginEmail = document.getElementById("email");

  const loginPassword = document.getElementById("password");


  function validarLoginEmail() {

    const valor = loginEmail.value.trim();

    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    loginEmail.classList.remove("is-valid", "is-invalid");


    if (!valor || !regex.test(valor)) {

      loginEmail.classList.add("is-invalid");

      return false;

    }


    loginEmail.classList.add("is-valid");

    return true;

  }


  function validarLoginPassword() {

    const valor = loginPassword.value.trim();

    const longitud = /^.{8,15}$/;

    const mayus = /[A-Z]/;

    const minus = /[a-z]/;

    const digito = /\d/;

    const especial = /[!@#$%^&*(),.?":{}|<>]/;

    const sinEspacios = /^\S+$/;


    loginPassword.classList.remove("is-valid", "is-invalid");


    const esValida = valor && longitud.test(valor) && mayus.test(valor) && minus.test(valor) && digito.test(valor) && especial.test(valor) && sinEspacios.test(valor);


    if (!esValida) {

      loginPassword.classList.add("is-invalid");

      loginPassword.setCustomValidity("Contraseña incorrecta");

      return false;

    } else {

      loginPassword.setCustomValidity("");

      loginPassword.classList.add("is-valid");

      return true;

    }

  }


  if (loginForm) {

    loginForm.addEventListener("submit", e => {

      if (!validarLoginEmail() || !validarLoginPassword()) {

        e.preventDefault();

      }

    });


    loginEmail.addEventListener("input", validarLoginEmail);

    loginPassword.addEventListener("input", validarLoginPassword);

  }

});

