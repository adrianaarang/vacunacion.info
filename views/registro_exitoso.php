<?php
require_once __DIR__ . '/header.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro con éxito</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<section class="container my-5 text-center">
  <div class="alert alert-success shadow p-4 rounded-4">
    <h2 class="mb-3">¡Registro completado con éxito!</h2>
    <p class="lead">Ya puedes iniciar sesión en tu cuenta para acceder a todos los servicios de Vacunacion.info.</p>

    <div class="mt-4">
      <a href="/index.php" class="btn btn-outline-primary me-2">
        <i class="fas fa-home"></i> Ir al inicio
      </a>
      <a href="#" id="abrirLoginDesdeExito" class="btn btn-primary">
        <i class="fas fa-sign-in-alt"></i> Iniciar sesión
      </a>
    </div>
  </div>
</section>

<!-- JS para mostrar modal de login -->
<script>
  document.getElementById("abrirLoginDesdeExito")?.addEventListener("click", function (e) {
    e.preventDefault();
    document.getElementById("loginOverlay").style.display = "flex";
    window.scrollTo(0, 0);
  });
</script>

<!-- JS externos -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/views/javascript/login.js"></script>
<script src="/views/javascript/registro.js"></script>

</body>
</html>

<?php
require_once __DIR__ . '/footer.php';
?>
