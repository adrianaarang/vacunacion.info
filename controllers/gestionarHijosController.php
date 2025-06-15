<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/BBDD.php';

// ✅ Solo permitir acceso si está logueado
if (!isset($_SESSION['id'])) {
    header('Location: /index.php');
    exit;
}

$db = new BBDD();
$usuarioId = (int) $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ➕ Añadir nuevo hijo
    if (!empty($_POST['nueva_fecha'])) {
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST['nueva_fecha'])) {
            $db->insertarHijo($usuarioId, $_POST['nueva_fecha']);
            header('Location: /views/gestionar_hijos.php?accion=anadido');
        } else {
            header('Location: /views/gestionar_hijos.php?error=fecha_invalida');
        }
        exit;
    }

    // 🗑️ Eliminar hijo
    if (isset($_POST['eliminar_id'])) {
        if ($db->eliminarHijo($usuarioId, (int)$_POST['eliminar_id'])) {
            header('Location: /views/gestionar_hijos.php?accion=eliminado');
        } else {
            header('Location: /views/gestionar_hijos.php?error=no_encontrado');
        }
        exit;
    }

    // ✏️ Actualizar fechas
    if (isset($_POST['fechas']) && is_array($_POST['fechas'])) {
        $errores = 0;
        foreach ($_POST['fechas'] as $id => $fecha) {
            if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
                $db->actualizarFechaHijo($usuarioId, (int)$id, $fecha);
            } else {
                $errores++;
            }
        }
        if ($errores > 0) {
            header('Location: /views/gestionar_hijos.php?error=actualizacion_parcial');
        } else {
            header('Location: /views/gestionar_hijos.php?accion=actualizado');
        }
        exit;
    }
}
