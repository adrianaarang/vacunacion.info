<?php

require_once 'header.php';

require_once '../controllers/recordatoriosEnviadosController.php';

?>


<section class="container my-5">

  <h2 class="mb-4 text-center">Recordatorios Enviados</h2>


  <?php if (empty($recordatorios)): ?>

    <div class="alert alert-info text-center">No se han enviado recordatorios aún.</div>

  <?php else: ?>

    <div class="table-responsive">

      <table class="table table-bordered table-hover">

        <thead class="table-light text-center">

          <tr>

            <th>Usuario</th>

            <th>Email</th>

            <th>Fecha de nacimiento del hijo</th>

            <th>Vacuna</th>

            <th>Edad (meses)</th>

            <th>Días antes</th>

            <th>Fecha de envío</th>

          </tr>

        </thead>

        <tbody>

          <?php foreach ($recordatorios as $r): ?>

            <tr class="text-center">

              <td><?= htmlspecialchars($r['nombre_usuario']) ?></td>

              <td><?= htmlspecialchars($r['email']) ?></td>

              <td><?= date('d/m/Y', strtotime($r['fecha_nacimiento'])) ?></td>

              <td><?= htmlspecialchars($r['vacuna_nombre']) ?></td>

              <td><?= $r['edad_meses'] ?></td>

              <td><?= $r['dias_antes'] ?> días</td>

              <td><?= date('d/m/Y', strtotime($r['fecha_envio'])) ?></td>

            </tr>

          <?php endforeach; ?>

        </tbody>

      </table>

    </div>

  <?php endif; ?>

</section>


<?php require_once 'footer.php'; ?>

