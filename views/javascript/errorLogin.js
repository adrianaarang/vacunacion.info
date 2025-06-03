window.addEventListener("DOMContentLoaded", function () {
  // Este dato lo inyectará PHP si hay error
  const mensajeError = window.errorLoginMensaje;

  if (mensajeError) {
    const errorLogin = document.getElementById("errorLogin");
    const loginOverlay = document.getElementById("loginOverlay");

    if (errorLogin && loginOverlay) {
      errorLogin.textContent = mensajeError;
      errorLogin.style.display = "block";
      loginOverlay.style.display = "flex";
      document.body.style.overflow = "hidden";

      // Enfocar el campo de email
      const loginEmail = document.getElementById("email");
      if (loginEmail) loginEmail.focus();

      // Ocultar después de 5 segundos
      setTimeout(() => {
        errorLogin.style.display = "none";
      }, 5000);
    }
  }
});
