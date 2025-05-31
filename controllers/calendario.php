<?php
// Inicia la sesión para acceder a las variables de sesión (como el ID del usuario logueado)
session_start();

// Incluye el archivo que contiene la clase de conexión a la base de datos
require_once '../models/BBDD.php';

// Verifica si el usuario está autenticado. Si no lo está, lo redirige a la página de inicio
if (!isset($_SESSION['id'])) {
    header("Location: home.php");
    exit;
}

// Crea una instancia de la base de datos
$db = new BBDD();
$usuarioId = $_SESSION['id']; // ID del usuario actual

// Consulta para obtener las fechas de nacimiento de todos los hijos del usuario
$sql = "SELECT fecha_nacimiento FROM hijos WHERE usuario_id = :id";
$stmt = $db->db->prepare($sql);
$stmt->execute(['id' => $usuarioId]);
$hijos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calendario de vacunas simplificado: nombre de la vacuna y desplazamiento desde el nacimiento
$vacunas = [
  ["Hexavalente", "+2 months"],
  ["Neumococo", "+2 months"],
  ["Rotavirus", "+2 months"],
  ["Meningococo B", "+4 months"],
  ["Triple vírica", "+12 months"],
  ["Varicela", "+15 months"],
  ["VPH", "+12 years"]
];
?>

<!-- Sección principal del contenido -->
<section class="container my-5">
  <h2 class="text-center mb-4">Calendario de Vacunación Personalizado</h2>

  <!-- Muestra un mensaje si el usuario no tiene hijos registrados -->
  <?php if (empty($hijos)): ?>
    <div class="alert alert-warning text-center">No tienes hijos registrados actualmente.</div>

  <!-- Si hay hijos, se muestra una tarjeta por cada uno con su calendario de vacunas -->
  <?php else: ?>
    <?php foreach ($hijos as $index => $hijo): ?>
      <div class="card mb-4">
        <div class="card-header bg-primary text-white">
          <!-- Encabezado con el número de hijo y su fecha de nacimiento -->
          Hijo <?= $index + 1 ?> — Fecha de nacimiento: <?= date("d/m/Y", strtotime($hijo['fecha_nacimiento'])) ?>
        </div>
        <div class="card-body">
          <ul class="list-group">
            <!-- Recorremos cada vacuna del calendario simplificado -->
            <?php foreach ($vacunas as [$nombre, $offset]): 
              // Calculamos la fecha en que le tocaría la vacuna aplicando el desplazamiento a la fecha de nacimiento
              $fechaVacuna = (new DateTime($hijo['fecha_nacimiento']))->modify($offset);
            ?>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong><?= $nombre ?></strong>
                <!-- Mostramos la fecha estimada de vacunación -->
                <span><?= $fechaVacuna->format('d/m/Y') ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</section>

