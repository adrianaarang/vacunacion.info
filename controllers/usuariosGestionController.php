<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/BBDD.php';

// Solo permitir acceso si es administrador
if (!isset($_SESSION['email']) || $_SESSION['email'] !== 'administrador@vacunacion.info') {
    header("Location: /index.php");
    exit;
}

$db = new BBDD();

// Procesar formulario de eliminación
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_id'])) {
    $idEliminar = (int)$_POST['eliminar_id'];

    if ($db->eliminarUsuarioConHijos($idEliminar)) {
        header("Location: /views/usuarios_gestion.php?mensaje=eliminado");
    } else {
        header("Location: /views/usuarios_gestion.php?mensaje=error");
    }
    exit;
}
