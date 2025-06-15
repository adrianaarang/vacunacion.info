<?php
// ✅ Inicia la sesión
session_start();

// ✅ Incluye el modelo de la base de datos
require_once __DIR__ . '/../models/BBDD.php';

// ✅ Verifica si el usuario está logueado
if (!isset($_SESSION['id'])) {
    header("Location: /views/home.php");
    exit;
}

$db = new BBDD();
$usuarioId = $_SESSION['id'];

// ✅ Intenta eliminar el usuario y sus hijos
$eliminado = $db->eliminarUsuarioConHijos($usuarioId);

if ($eliminado) {
    session_unset();
    session_destroy();
    header("Location: /views/home.php?cuenta=eliminada");
    exit;
} else {
    header("Location: /views/panel_usuario.php?error=eliminar");
    exit;
}
