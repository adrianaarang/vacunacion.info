<!-- Login Overlay -->

<div class="login-overlay" id="loginOverlay" style="display: none;">

  <div class="login-modal shadow rounded-4 position-relative bg-white p-4" style="max-width: 420px; margin: auto;">

    <button class="btn-close position-absolute top-0 end-0 m-3" id="cerrarLogin"></button>

    <h2 class="titulo-formulario text-center mb-4">¡Te estábamos esperando!</h2>


    <div class="tab-buttons mb-3 text-center">

      <button class="btn btn-primary active">Ya soy usuario</button>

      <button class="btn btn-outline-primary" id="abrirRegistro">Soy nuevo</button>

    </div>


    <?php if (isset($_GET['info']) && $_GET['info'] === 'contrasena_actualizada'): ?>

      <div class="alert alert-success text-center mb-3">

        Tu contraseña se ha actualizado correctamente. Ya puedes iniciar sesión.

      </div>

    <?php endif; ?>


    <div id="errorLogin" class="alert alert-danger text-center mb-3" style="display: none;"></div>


    <form id="form-login" action="/controllers/procesarLogin.php" method="POST">

      <div class="mb-3">

        <label for="email" class="form-label">Correo Electrónico</label>

        <input type="email" id="email" name="email" required class="form-control" />

      </div>


      <div class="mb-3">

        <label for="password" class="form-label">Contraseña</label>

        <input type="password" id="password" name="password" required class="form-control" />

      </div>


      <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>


      <div class="text-center mt-3">

        <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" class="text-decoration-none">¿Olvidaste tu contraseña?</a>

      </div>

    </form>

  </div>

</div>


<!-- Modal Recuperar Contraseña -->

<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="forgotPasswordModalLabel">Restablecer Contraseña</h5>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>

      </div>

      <div class="modal-body">

        <p class="text-center">Introduce tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña.</p>

        <div id="resetPasswordMessage" class="alert d-none" role="alert"></div>


        <form id="forgotPasswordForm" action="/controllers/reset_password_request.php" method="POST">

          <div class="mb-3">

            <label for="resetEmail" class="form-label">Correo Electrónico:</label>

            <input type="email" class="form-control" id="resetEmail" name="email" required>

          </div>

          <button type="submit" class="btn btn-primary w-100">Enviar enlace de restablecimiento</button>

        </form>

      </div>

    </div>

  </div>

</div>


<!-- Registro Overlay -->

<div class="registro-overlay" id="registroOverlay" style="display: none;">

  <div class="registro-modal shadow rounded-4 position-relative bg-white p-4" style="max-width: 500px; margin: auto; max-height: 90vh; overflow-y: auto;">

    <button class="btn-close position-absolute top-0 end-0 m-3" id="cerrarRegistro"></button>

    <h2 class="titulo-formulario text-center mb-4">¡Bienvenido a Vacunacion.info!</h2>


    <div class="tab-buttons mb-3 text-center">

      <button class="btn btn-outline-primary" id="mostrarLoginDesdeRegistro">Ya soy usuario</button>

      <button class="btn btn-primary active">Soy nuevo</button>

    </div>


    <form id="form-register" action="/controllers/procesarRegistro.php" method="POST">

      <div class="mb-3">

        <label for="nombre" class="form-label">Nombre Completo</label>

        <input type="text" id="nombre" name="nombre" required class="form-control">

        <div id="errorNombre" class="invalid-feedback"></div>

      </div>


      <div class="mb-3">

        <label for="emailRegistro" class="form-label">Correo Electrónico</label>

        <input type="email" id="emailRegistro" name="email" required class="form-control">

        <div id="errorEmailRegistro" class="invalid-feedback"></div>

      </div>


      <div class="mb-3">

        <label for="passwordRegistro" class="form-label">Contraseña</label>

        <input type="password" id="passwordRegistro" name="password" required class="form-control">

        <div id="errorPasswordRegistro" class="invalid-feedback"></div>

      </div>


      <input type="hidden" name="perfil" value="madre_padre">


      <div class="mb-3">

        <label for="num_hijos" class="form-label">Número de Hijos</label>

        <input type="number" id="num_hijos" name="num_hijos" min="1" required class="form-control">

        <div id="children-dates"></div>

      </div>


      <div class="mb-3">

        <label for="comunidad_id" class="form-label">Comunidad Autónoma</label>

        <select id="comunidad_id" name="comunidad_id" required class="form-select">

          <option value="" disabled selected>Selecciona tu comunidad</option>

          <!-- Aquí se inyectan las opciones -->

        </select>

      </div>


      <div class="form-check mb-3">

        <input class="form-check-input" type="checkbox" id="comunicaciones" name="comunicaciones" required>

        <label class="form-check-label" for="comunicaciones">

          Acepto recibir comunicaciones comerciales personalizadas de Vacunacion.info.

          <a href="/politica-privacidad" target="_blank">Ver Política de privacidad</a>

        </label>

      </div>


      <button type="submit" class="btn btn-primary w-100">Registrarse</button>

    </form>

  </div>

</div>


