<?php
// ✅ Controlador para generar el calendario de vacunación personalizado del usuario

require_once '../models/BBDD.php';
session_start();

// Si no hay sesión iniciada, redirige
if (!isset($_SESSION['id'])) {
    header("Location: home.php");
    exit;
}

$db = new BBDD();
$usuarioId = $_SESSION['id'];
$usuario = $db->getUsuarioPorId($usuarioId);
$comunidadId = $usuario['comunidad_id'];

// 🔽 Obtener hijos del usuario
$hijos = $db->obtenerHijosPorUsuario($usuarioId);

// 🔽 Ver si hay filtro de hijo por GET
$hijoIdFiltrado = isset($_GET['hijo_id']) && is_numeric($_GET['hijo_id']) ? (int)$_GET['hijo_id'] : null;

$eventos = [];
$hoy = new DateTime();

foreach ($hijos as $hijo) {
    // 🔍 Aplicar filtro si se especificó un hijo
    if ($hijoIdFiltrado && $hijo['id'] !== $hijoIdFiltrado) {
        continue;
    }

    $fechaNacimiento = new DateTime($hijo['fecha_nacimiento']);

    // 🔽 Obtener vacunas aplicables
    $vacunas = $db->obtenerVacunasPorEdadYComunidad($comunidadId, 240); // hasta 20 años

    foreach ($vacunas as $vacuna) {
        $fechaVacuna = clone $fechaNacimiento;
        $fechaVacuna->modify('+' . $vacuna['edad_meses'] . ' months');

        $eventos[] = [
            'title' => $vacuna['nombre'] . ' - ' . ($vacuna['es_financiada'] ? 'Financiada' : 'No financiada'),
            'start' => $fechaVacuna->format('Y-m-d'),
            'description' => $vacuna['descripcion'],
            'color' => $vacuna['es_financiada'] ? '#198754' : '#ffc107'
        ];
    }
}

if (isset($_GET['json'])) {
    header('Content-Type: application/json');
    echo json_encode($eventos);
    exit;
}

// ✅ Si no es llamada JSON, cargar vista HTML
include '../views/calendario_usuario.php';
