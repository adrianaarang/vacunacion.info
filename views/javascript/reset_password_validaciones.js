document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("form-password-reset");

    const nueva = document.getElementById("nueva_contrasena");

    const confirmar = document.getElementById("confirmar_contrasena");

    const errorNueva = document.getElementById("errorNueva");

    const errorConfirmar = document.getElementById("errorConfirmar");


    function validarNuevaContrasena() {

      const valor = nueva.value.trim();

      const longitud = /^.{8,15}$/;

      const mayus = /[A-Z]/;

      const minus = /[a-z]/;

      const digito = /\d/;

      const especial = /[!@#$%^&*(),.?":{}|<>]/;

      const sinEspacios = /^\S+$/;


      nueva.classList.remove("is-valid", "is-invalid");

      errorNueva.textContent = "";


      if (!valor) {

        errorNueva.textContent = "La contraseña es obligatoria.";

        nueva.classList.add("is-invalid");

        return false;

      }


      const esValida = longitud.test(valor) && mayus.test(valor) && minus.test(valor) && digito.test(valor) && especial.test(valor) && sinEspacios.test(valor);


      if (!esValida) {

        errorNueva.textContent = "Debe tener entre 8 y 15 caracteres, incluir mayúsculas, minúsculas, un número y un símbolo.";

        nueva.classList.add("is-invalid");

        return false;

      }


      nueva.classList.add("is-valid");

      return true;

    }


    function validarConfirmarContrasena() {

      const nuevaValor = nueva.value.trim();

      const confirmarValor = confirmar.value.trim();


      confirmar.classList.remove("is-valid", "is-invalid");

      errorConfirmar.textContent = "";


      if (!confirmarValor) {

        errorConfirmar.textContent = "Debes confirmar la contraseña.";

        confirmar.classList.add("is-invalid");

        return false;

      }


      if (nuevaValor !== confirmarValor) {

        errorConfirmar.textContent = "Las contraseñas no coinciden.";

        confirmar.classList.add("is-invalid");

        return false;

      }


      confirmar.classList.add("is-valid");

      return true;

    }


    if (form) {

      form.addEventListener("submit", function (e) {

        if (!validarNuevaContrasena() || !validarConfirmarContrasena()) {

          e.preventDefault();

        }

      });


      nueva.addEventListener("input", validarNuevaContrasena);

      confirmar.addEventListener("input", validarConfirmarContrasena);

    }

  });
