<?php


require_once 'header.php'; // Ruta relativa desde views/

?>


<section class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">

  <div class="card shadow-lg border-danger text-center p-4" style="max-width: 400px;">

    <h3 class="text-danger mb-3">❌ Error en el registro</h3>

    <p class="mb-4">El correo electrónico ya está registrado en la plataforma.</p>

    <a href="../index.php" class="btn btn-outline-primary">Volver al inicio</a>

  </div>

</section>


<?php

require_once 'footer.php';

?>


