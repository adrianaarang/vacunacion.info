<?php
// ✅ Inicia la sesión para poder acceder a la variable de sesión del usuario
session_start();

// ✅ Incluye la clase que maneja la conexión y operaciones con la base de datos
require_once '../models/BBDD.php';

// ✅ Verifica si el usuario está logueado
if (!isset($_SESSION['id'])) {
    // Si no hay sesión activa, redirige al inicio
    header("Location: ../views/home.php");
    exit;
}

// ✅ Crea una instancia del modelo de base de datos
$db = new BBDD();

// ✅ Recupera el ID del usuario actualmente logueado desde la sesión
$usuarioId = $_SESSION['id'];

// ✅ Intenta eliminar el usuario y todos sus hijos asociados mediante método del modelo
$eliminado = $db->eliminarUsuarioConHijos($usuarioId);

// ✅ Si la eliminación fue exitosa:
if ($eliminado) {
    // Limpia todas las variables de sesión
    session_unset();

    // Destruye completamente la sesión
    session_destroy();

    // Redirige al inicio con un mensaje indicando que la cuenta fue eliminada
    header("Location: ../views/home.php?cuenta=eliminada");
    exit;

// ❌ Si hubo algún error al intentar eliminar:
} else {
    // Redirige al panel del usuario mostrando un error
    header("Location: ../views/panel_usuario.php?error=eliminar");
    exit;
}

