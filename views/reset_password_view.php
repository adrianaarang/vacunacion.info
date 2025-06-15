<?php require_once __DIR__ . '/header.php'; ?>


<div class="container py-5">

  <div class="row justify-content-center">

    <div class="col-md-6 col-lg-5">

      <div class="card shadow rounded-4">

        <div class="card-body p-4">

          <h3 class="text-center mb-4">Restablecer Contraseña</h3>


          <?php if (isset($error)): ?>

            <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>

          <?php else: ?>

            <form method="POST" id="form-password-reset" action="/controllers/procesarNuevaPassword.php">

              <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">


              <div class="mb-3">

                <label for="nueva_contrasena" class="form-label">Contraseña nueva</label>

                <input type="password" name="nueva_contrasena" id="nueva_contrasena" required class="form-control">


                <div id="errorNueva" class="invalid-feedback"></div>

              </div>


              <div class="mb-3">

                <label for="confirmar_contrasena" class="form-label">Confirmar contraseña</label>

                <input type="password" name="confirmar_contrasena" id="confirmar_contrasena" required class="form-control">

                <div id="errorConfirmar" class="invalid-feedback"></div>

              </div>


              <button type="submit" class="btn btn-primary w-100">Guardar nueva contraseña</button>

            </form>

          <?php endif; ?>

        </div>

      </div>

    </div>

  </div>

</div>


<?php require_once __DIR__ . '/footer.php'; ?>
