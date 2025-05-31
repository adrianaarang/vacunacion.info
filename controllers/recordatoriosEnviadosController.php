<?php

require_once '../models/BBDD.php';

// Solo permitir acceso si es administrador
if (!isset($_SESSION['email']) || $_SESSION['email'] !== 'administrador@vacunacion.info') {
    header("Location: home.php");
    exit;
}

$db = new BBDD();
$conn = $db->getConexion();

// Obtener recordatorios enviados con información del hijo y usuario
$sql = "SELECT re.*, h.fecha_nacimiento, u.nombre AS nombre_usuario, u.email
        FROM recordatorios_enviados re
        JOIN hijos h ON re.hijo_id = h.id
        JOIN usuarios u ON h.usuario_id = u.id
        ORDER BY re.fecha_envio DESC";

$recordatorios = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Administración</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">

</head>
<body>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
